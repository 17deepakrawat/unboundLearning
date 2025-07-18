<div class="modal-header">
    <h5 class="modal-title">Notification</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label" for="type"><b>Type</b></label>
                <p> {{$notification->type}} </p>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="title"><b>Title</b></label>
                <p>{{$notification->title}}</p>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="description"><b>Description</b></label>
                <p> {!!$notification->description!!} </p>
            </div>
            @if ($notification->attachment!='')
            <div class="col-md-6">
                <label class="form-label" for="attachment"><b>Attachment</b></label>
                <a href="{{asset($notification->attachment)}}" target="_blank">View</a>
            </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    </div>

