@extends('layouts.public_app')

@section('content')

<!-- #header -->
<div id="main" class="site-main">
    
	<div class="container">
		<div class="row">
			<!--Latest offers-->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">

                    <div class="col-sm-3">
                        <div class="col-sm-12">
                            <div class="filter cata-dis-none">
                                <h1 class="brand-header">Super Categories </h1>
                                <div class="list-group category_list">
                                    @foreach($super_catgories as $supercat)                                        
                                        <a href="{{ route('categories', ['super_cat_id' => $supercat->id]) }}" class="list-group-item">
                                            {{ ucwords($supercat->name) }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="col-sm-9">

                        <div class="col-sm-12 p0">
                            <h1 class="brand-header">Categories </h1>
                        </div>

						<div class="row">                            
                            @if(!empty($categories[0]))

                                @foreach($categories as $category)
									<div class="col-lg-2 col-sm-2 col-xs-12 text-center-img height_145">
                                        <a href="javascript:;" class="cat_ies" id="cate_<?= $category->id; ?>">
                                            <img alt="" src="{{url('/')}}/storage/app/uploads/categories/<?= $category->image; ?>" class="img-responsive" style="height: 100px;">
                                            <span>
                                                {{ ucwords($category->category) }}
                                            </span>
										</a>
									</div>
                                @endforeach

                            @else
                                <div class="col-md-12">
                                    <div class="col-md-12 alert alert-info">
                                        Result not found!
                                    </div>
                                </div>
                            @endif
						</div>                                             
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection



