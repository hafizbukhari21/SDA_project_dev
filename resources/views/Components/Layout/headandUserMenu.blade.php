 <!-- Nav Item - Pages Collapse Menu -->
 <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Project</span>
    </a>
    <div id="collapseTwo" class="collapse timelineDropdown" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Components:</h6>
            <a class="collapse-item" href="{{ route('project.create') }}">Create </a>
            <a class="collapse-item timeLineChild"  >Timeline</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Timesheet</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @if (session()->get("sessionKey")["role"]=='Head')
                <a class="collapse-item" href="{{ route('show.timesheet.approval') }}">Approval</a>
            @else
                <a class="collapse-item" href="{{ route('show.timesheet') }}">Create </a>
                <a class="collapse-item" href="{{ route('submission.timesheet') }}">Submission </a>

            @endif
        </div>
    </div>
</li>