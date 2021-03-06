@extends('redminportal::layouts.bare')

@section('content')
    
    @include('redminportal::partials.errors')

    {!! Form::open(array('files' => TRUE, 'action' => '\Redooor\Redminportal\App\Http\Controllers\ProductController@postStore', 'role' => 'form')) !!}

    {!! Form::hidden('product_id', $product_id, array('id' => 'product_id')) !!}

    	<div class='row'>
	        <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">{{ Lang::get('redminportal::forms.create_product_variation') }}</h4>
                    </div>
                    <div class="panel-body">
                        @include('redminportal::partials.lang-selector-form', ['selector_name' => '-variant'])
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">{{ Lang::get('redminportal::forms.product_properties') }}</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            {!! Form::label('sku', Lang::get('redminportal::forms.sku')) !!}
                            {!! Form::text('sku', old('sku'), array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', Lang::get('redminportal::forms.price')) !!}
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                {!! Form::text('price', old('price'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', Lang::get('redminportal::forms.tags_separated_by_comma')) !!}
                            {!! Form::text('tags', old('tags'), array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            {{ Lang::get('redminportal::forms.product_shipping_properties') }}
                        </h4>
                    </div>
                    <div class="panel-body">
                        <!-- Weight information -->
                        <div class="form-group">
                            <label>{{ Lang::get('redminportal::forms.weight') }}</label>
                            <div class="form-inline">
                                {!! Redminportal::form()->inputer('weight', old('weight'), [
                                    'label' => Lang::get('redminportal::forms.weight'),
                                    'label_classes' => 'sr-only',
                                    'type' => 'number',
                                    'step' => '0.001',
                                    'placeholder' => '0.00'
                                ]) !!}
                                {!! Redminportal::form()->selector('weight_unit', $weight_units, old('weight_unit'), [
                                    'label' => Lang::get('redminportal::forms.weight_unit'),
                                    'label_classes' => 'sr-only',
                                    'value_as_key' => true
                                ]) !!}
                            </div>
                        </div>
                        <!-- Volume information -->
                        <div class="form-group">
                            <label>{{ Lang::get('redminportal::forms.volume') }}</label>
                            <div class="form-inline">
                                {!! Redminportal::form()->inputer('length', old('length'), [
                                    'label' => Lang::get('redminportal::forms.length'),
                                    'label_classes' => 'sr-only',
                                    'type' => 'number',
                                    'step' => '0.001',
                                    'placeholder' => '0.00',
                                    'help_text' => Lang::get('redminportal::forms.length')
                                ]) !!}
                                {!! Redminportal::form()->inputer('width', old('width'), [
                                    'label' => Lang::get('redminportal::forms.width'),
                                    'label_classes' => 'sr-only',
                                    'type' => 'number',
                                    'step' => '0.001',
                                    'placeholder' => '0.00',
                                    'help_text' => Lang::get('redminportal::forms.width')
                                ]) !!}
                                {!! Redminportal::form()->inputer('height', old('height'), [
                                    'label' => Lang::get('redminportal::forms.height'),
                                    'label_classes' => 'sr-only',
                                    'type' => 'number',
                                    'step' => '0.001',
                                    'placeholder' => '0.00',
                                    'help_text' => Lang::get('redminportal::forms.height')
                                ]) !!}
                                {!! Redminportal::form()->selector('volume_unit', $volume_units, old('volume_unit'), [
                                    'label' => Lang::get('redminportal::forms.volume_unit'),
                                    'label_classes' => 'sr-only',
                                    'value_as_key' => true,
                                    'help_text' => Lang::get('redminportal::messages.unit_applies_to_all_dimensions')
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
	        </div>
            <div class="col-sm-4">
                <div class="well hidden-xs">
                    <div class='form-actions text-right'>
                        {!! Form::submit(Lang::get('redminportal::buttons.create'), array('class' => 'btn btn-primary btn-sm')) !!}
                    </div>
                </div>
                <div class='well well-small'>
                    <div class="form-group">
                        <div class="checkbox">
                            <label for="featured-checker">
                                {!! Form::checkbox('featured', true, true, array('id' => 'featured-checker')) !!} {{ Lang::get('redminportal::forms.featured') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label for="active-checker">
                                {!! Form::checkbox('active', true, true, array('id' => 'active-checker')) !!} {{ Lang::get('redminportal::forms.active') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">{{ trans('redminportal::forms.category') }}</div>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" 
                               id="category_id" 
                               name="category_id" 
                               value="{{ $product->category_id }}">
                        <ul class="redmin-hierarchy">
                            <li><a class="active">{{ $product->category->name }}</a></li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <i><small>{{ trans('redminportal::messages.product_variant_inherits_from_parent_footnote') }}</small></i>
                    </div>
                </div>
		        <div>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileupload-new">{{ Lang::get('redminportal::forms.select_image') }}</span><span class="fileupload-exists">{{ Lang::get('redminportal::forms.change_image') }}</span>{!! Form::file('image') !!}</span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">{{ Lang::get('redminportal::forms.remove_image') }}</a>
                      </div>
                    </div>
                </div>
                <div class="well visible-xs">
                    <div class='form-actions text-right'>
                        {!! Form::submit(Lang::get('redminportal::buttons.create'), array('class' => 'btn btn-primary btn-sm')) !!}
                    </div>
                </div>
	        </div>
        </div>
    {!! Form::close() !!}
@stop

@section('footer')
    @parent
    <script src="{{ URL::to('vendor/redooor/redminportal/js/bootstrap-fileupload.js') }}"></script>
    @include('redminportal::plugins/tinymce')
    @include('redminportal::plugins/tagsinput')
@stop
