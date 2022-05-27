@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard | Admin')

@section('content')
<script type="text/javascript">

    function deleteAudit(data) {
      document.getElementById('recordId').value=data.id ;
      console.log(data)
    }
    function editAudit(data) {
      document.getElementById('auditId').value=data.id ;
      document.getElementById('auditIp').value=data.device ;
      document.getElementById('auditDevice').value=data.device_name ;
      document.getElementById('auditPlatform').value=data.platform ;
      document.getElementById('auditBrowser').value=data.browser ;
      console.log(data)
    }
  </script>
<div class="row">
  <center>
    @if(session()->has('success'))
       <div class="alert alert-success p-1 mt-1">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
       <div class="alert alert-danger p-1 mt-1">
            {{ session()->get('error') }}
        </div>
    @endif
  </center>
    
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title mb-3">Audit Logs</p>
        <div class="table-responsive">
          <table class="table table-striped table-borderless">
            <thead>
              <tr>
                <th class="table-border">User</th>
                <th class="table-border">IP</th>
                <th class="table-border">Device</th>
                <th class="table-border">OS</th>
                <th class="table-border">Browser</th>
                <!-- <th class="table-border">User Agent</th> -->
                <th class="table-border">Login at</th>
                <th class="table-border">Loginout at</th>
                <th class="table-border">Actions</th>
              </tr>  
            </thead>
            <tbody>
              @if(count($audits))
                @foreach ($audits as $audit)
                  <tr class="table-border">
                    <td>
                    @if($audit['user'])
                      <b>{{ $audit['user']['name'] }}</b>
                    @endif
                    </td>
                    <td>{{ $audit['ip'] }}</td>
                    <td><b >{{$audit['device_name']}}</b> - {{ $audit['device'] }}</td>
                    <td><b >{{ $audit['platform'] }}</b> - {{$audit['platform_version']}}</td>
                    <td><b >{{ $audit['browser'] }}</b> - {{$audit['browser_version']}}</td>
                    <!-- <td style="max-width: 100px;">{{ $audit['agent'] }}</td> -->
                    <td>{{ \Carbon\Carbon::parse($audit['created_at'])->timezone('Asia/Kolkata')->format('j F, Y h:i') }}</td>
                    <td>@if($audit['logout']) {{ \Carbon\Carbon::parse($audit['logout'])->timezone('Asia/Kolkata')->format('j F, Y h:i') }} @endif</td>
                    <td><i class="mdi mdi-table-edit mdi-icon" onclick="editAudit({{$audit}})" data-toggle="modal" data-target="#editModal"></i><i class="mdi mdi-delete-forever mdi-icon" onclick="deleteAudit({{$audit}})" data-toggle="modal" data-target="#deleteModal"></i></td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Audit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you want to delete this audit?
      </div>
      <form class="validate-form " action="{{ route('delete_audit') }}" method="POST" >
        @csrf
        <input type="hidden" name="id" value="" id="recordId">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="validate-form " action="{{ route('edit_audit') }}" method="POST" >
        @csrf
        <input type="hidden" name="id" value="" id="auditId">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Audit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" id="auditIp" placeholder="ip" name="ip" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" id="auditDevice" placeholder="Device" name="device_name" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" id="auditPlatform" placeholder="Platform" name="platform" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" id="auditBrowser" placeholder="Browser" name="browser" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection

@section('page-script')
  
@endsection