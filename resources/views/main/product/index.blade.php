@extends('layouts.main')
@section('header', 'Product')

@section('content')
<div id="controller">
    <div class="row">
        <div class="col-md-5 offset-md-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" autocomplete="off" placeholder="Search product name" v-model="search">
            </div>
        </div>

        <div class="col-md-2">
            <button class="btn btn-sm btn-primary btn-flat pull-right" @click="addData()"><i class="fas fa-plus-circle"></i>
                Create New Product
            </button>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12" v-for="product in filteredList">
            <div class="info-box" v-on:click="editData(product)">
                <div class="info-box-content">
                    <span class="info-box-text h3">@{{ product.name }} (@{{ product.qty }})</span>
                    <span class="info-box-text h3">@{{ product.category_id }}</span>
                    <span class="info-box-number">Rp. @{{ thousandSeparator(product.price) }},-<small></small></span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, product.id)">
                    <div class="modal-header">
                        <h4 class="modal-title">Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="put" v-if="editStatus">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" :value="product.name" required="">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                <option :selected="product.category_id == {{ $category->id }}" value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="qty" :value="product.qty" required="">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" :value="product.price" required="">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" v-if="editStatus" v-on:click="deleteData(product.id)">Delete</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    var actionUrl = '{{ url('products') }}';
    var apiUrl = '{{ url('api/products') }}';
    
    var app = new Vue({
        el: '#controller',
        data: {
            products: [],
            product: {},
            actionUrl,
            apiUrl,
            search: '',
            editStatus: false
        },
        mounted: function() {
            this.get_products();
        },
        methods: {
            get_products() {
                const _this = this;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(data) {
                        _this.products = JSON.parse(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            },
            addData() {
                this.product = {};
                this.editStatus = false;
                $('#modal-default').modal();
            },
            editData(product) {
                this.product = product;
                this.editStatus = true;
                $('#modal-default').modal();
            },
            deleteData(id) {
                this.actionUrl = '{{ url('products') }}'+'/'+id;
                if (confirm("Are you sure?")) {
                    axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                        location.reload();
                    });
                }
            },
            submitForm(event, id) {
            event.preventDefault();
            const _this = this;
            var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
            
            axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
                    location.reload();
                });
            },
            thousandSeparator(n) {
                return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        },
        computed: {
            filteredList() {
                return this.products.filter(product => {
                    return product.name.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    })
</script>
@endsection
