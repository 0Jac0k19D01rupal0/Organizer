<h2>Add a event</h2>

@if($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{route('create-event')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="titleid" class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-9">
            <input name="title" type="text" class="form-control" id="titleid" placeholder="Title">
        </div>
    </div>
    <div class="form-group row">
        <label for="descriptionid" class="col-sm-3 col-form-label">Describtion</label>
        <div class="col-sm-9">
            <input name="description" type="text" class="form-control" id="descriptionid"
                   placeholder="Description">
        </div>
    </div>
    <div class="form-group row">
        <label for="timeid" class="col-sm-3 col-form-label">Time</label>
        <div class="col-sm-9">
            <input name="time" type="text" class="form-control" id="timeid"
                   placeholder="Time">
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-3 col-sm-9">
            <button type="submit" class="btn btn-primary">Submit Event</button>
        </div>
    </div>
</form>

