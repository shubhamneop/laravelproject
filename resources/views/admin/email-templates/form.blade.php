<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change'] : ['class' => 'form-control','required' => 'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
    {!! Form::text('subject', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change'] : ['class' => 'form-control','required' => 'required','data-parsley-pattern'=>'/^[a-zA-Z]+([-_\s]{1}[a-zA-Z]+)*$/i','data-parsley-trigger'=>'change']) !!}
    {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
    {!! Form::textarea('message', null, ('required' == 'required') ? ['class' => 'form-control','id'=>'message', 'required' => 'required','data-parsley-trigger'=>'keyup' ,'data-parsley-minlength'=>'10' ,'data-parsley-maxlength'=>'10000','data-parsley-minlength-message'=>'Come on! You need to enter at message..','data-parsley-validation-threshold'=>'10'] : ['class' => 'form-control','id'=>'message','data-parsley-trigger'=>'keyup' ,'data-parsley-minlength'=>'10' ,'data-parsley-maxlength'=>'10000','data-parsley-minlength-message'=>'Come on! You need to enter at message..','data-parsley-validation-threshold'=>'10']) !!}
    {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
