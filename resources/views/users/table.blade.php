<!---->
<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Email Verified At</th>
                <!-- <th>Password</th>
                <th>Two Factor Secret</th>
                <th>Two Factor Recovery Codes</th>
                <th>Remember Token</th>
                <th>Current Team Id</th>
                <th>Profile Photo Path</th> -->
                <th>Role</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    <!-- <td>{{ $user->password }}</td>
                    <td>{{ $user->two_factor_secret }}</td>
                    <td>{{ $user->two_factor_recovery_codes }}</td>
                    <td>{{ $user->remember_token }}</td>
                    <td>{{ $user->current_team_id }}</td>
                    <td>{{ $user->profile_photo_path }}</td> -->            
                    <td>
                        <div style="display: flex;">                    
                            <div style="min-width: 50px;">
                                {{ $roleName = $user->getRoleNames()->implode(', ') }}
                            </div>                
                            @if('admin' !== $roleName)
                                {!! Form::open(['route' => ['block_user', $user], 'method' => 'get']) !!}
                                    {!! Form::button('Change', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}    
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </td>            
                    <td>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('users.show', [$user->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
