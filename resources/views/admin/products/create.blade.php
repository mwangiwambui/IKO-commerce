<?php
?>
@extends('admin.layout.main')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                    <div class="card">
                        <div class="card-header">
                            <strong>IKO Products</strong> Items
                        </div>
                        @if($success = Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{session('message')}}
                            </div>
                        @endif
                        @if ($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach

                        @endif

                        <div class="card-body card-block">
                            {!! Form::open(['route' => 'product.store','method'=> 'post','files'=>true]) !!}



                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label('name', 'Name') }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ Form::text('name', null, array('class' => 'form-control','required'=>'','minlength'=>'5','placeholder'=>'Enter name of Product')) }}
                                        <small class="form-text text-muted">This is a help text</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label('description', 'Description') }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ Form::text('description', null, array('class' => 'form-control','required'=>'','placeholder'=>'Enter description')) }}
                                        <small class="form-text text-muted">This is a help text</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label('price', 'Price') }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ Form::text('price', null, array('class' => 'form-control','required'=>'','placeholder'=>'Enter price in dollars')) }}
                                        <small class="form-text text-muted">This is a help text</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label('category_id', 'Categories') }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ Form::select('category_id',$categories, null, array('class' => 'form-control custom-select','id' => 'customSelect','placeholder'=>'Select Category')) }}
                                        <small class="form-text text-muted">This is a help text</small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label('image', 'Image') }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ Form::file('image',array('class' => 'form-control')) }}
                                    </div>
                                </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    {{ Form::label('quantity', 'Quantity') }}
                                </div>
                                <div class="col-12 col-md-9">
                                    {{ Form::number('quantity', null, array('class' => 'form-control','required'=>'','placeholder'=>'Enter quantity of items in stock')) }}
                                    <small class="form-text text-muted">This is a help text</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    {{ Form::label('author', 'Author') }}
                                </div>
                                <div class="col-12 col-md-9">
                                    {{ Form::text('author', null, array('class' => 'form-control','required'=>'','placeholder'=>'Enter author of book')) }}
                                    <small class="form-text text-muted">This is a help text</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    {{ Form::label('synopsis', 'Synopsis') }}
                                </div>
                                <div class="col-12 col-md-9">
                                    {{ Form::textarea('synopsis', null, array('class' => 'form-control','required'=>'','placeholder'=>'Enter synopsis of book')) }}
                                    <small class="form-text text-muted">This is a help text</small>
                                </div>
                            </div>
                                <div class="card-footer">
                                    <i class="fa fa-dot-circle-o"></i>
                                        {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-sm')) }}
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>

                            {!! Form::close() !!}
                        </div>

                    </div>
                <div>
                    <table id="example" style="padding-left:-100px;" class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">author</th>
                            <th scope="col">image</th>
                            <th scope="col">price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">category</th>
                            <th scope="col">action</th>
                            <!-- <th scope="col">Image</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $value=1; ?>
                        @if(!empty($products))
                            @forelse($products as $product)
                                <tr>
                                    <td>{{$value++}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->author}}</td>
                                    <td>{{$product->image}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$categories[$product->category_id]}}</td>
                                    <td>
                                        <form action="{{route('product.destroy',$product->id)}}"  method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" type="submit"><i class="zmdi zmdi-delete"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th>1</th>
                                    <td>No Products</td>
                                </tr>
                            @endforelse
                        @endif

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>



@endsection
