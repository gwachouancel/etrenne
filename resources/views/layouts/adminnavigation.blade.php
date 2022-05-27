@php $routeName = request()->route()->getName(); $user = auth()->user(); @endphp
<div class="col-md-3">
    <div class="mt-4">
        <p><h5>Utilisateurs</h5></p>
        @if($user->hasMenu('admin.accounts'))
        <div class="form-check form-check-primary">
            <label class="form-check-label">
            <i class="fa fa-id-card-o text-param-ora icon-sm"></i>
            @if( $routeName == 'admin.accounts' || strpos($routeName, 'admin.user')!==false || strpos($routeName, 'admin.supplier')!==false )
            <strong>{{__('menus.account')}}</strong>
            @else
            <a href="{{route('admin.accounts')}}">{{__('menus.account')}}</a>
            @endif
            </label>
        </div>
        @endif

        @if($user->hasMenu('admin.permissions'))
        <div class="form-check form-check-danger">
            <label class="form-check-label">
            <i class="fa fa-building-o text-param-ora icon-sm"></i>
            @if( $routeName == 'admin.permissions' || strpos($routeName, 'admin.permission')!==false )
            <strong>{{__('admin/navigation.permissions')}}</strong>
            @else
            <a href="{{route('admin.permissions')}}">{{__('admin/navigation.permissions')}}</a>
            @endif
            </label>
        </div>
        @endif
    </div>
        <div class="mt-4">
        <p><h5>Parametres</h5></p>
        @if($user->hasMenu('admin.filiales'))
        <div class="form-check form-check-primary">
            <label class="form-check-label">
            <i class="fa fa-building-o text-param-ora icon-sm"></i>
            @if( $routeName == 'admin.filiales' || strpos($routeName, 'admin.filiale')!==false )
            <strong>{{__('admin/navigation.filiales')}}</strong>
            @else
            <a href="{{route('admin.filiales')}}">{{__('admin/navigation.filiales')}}</a>
            @endif
            </label>
        </div>
        @endif

        @if($user->hasMenu('admin.directions'))
        <div class="form-check form-check-danger">
            <label class="form-check-label">
            <i class="fa fa-building-o text-param-ora icon-sm"></i>
            @if( $routeName == 'admin.directions' || strpos($routeName, 'admin.direction')!==false )
            <strong>{{__('admin/navigation.directions')}}</strong>
            @else
            <a href="{{route('admin.directions')}}">{{__('admin/navigation.directions')}}</a>
            @endif
            </label>
        </div>
        @endif

        @if($user->hasMenu('admin.setting.close'))
        <div class="form-check form-check-danger">
            <label class="form-check-label">
            <i class="fa fa-lock text-param-ora icon-sm"></i>
            @php
                if(App\Models\Setting::where('slug','platform')->first()->data)
                    $closeText = __('admin/navigation.close_app');
                else
                    $closeText = __('admin/navigation.open_app');
            @endphp

            @if( $routeName == 'admin.setting.close'  )
            <strong>{{$closeText}}</strong>
            @else
            <a href="{{route('admin.setting.close')}}">{{$closeText}}</a>
            @endif
             
            </label>
        </div>
        @endif

        <div class="form-check form-check-danger">
            <label class="form-check-label">
            <i class="fa fa-folder-o text-param-ora icon-sm"></i>
            @if( $routeName == 'admin.setting.document')
            <strong>{{__('admin/setting.document_title')}}</strong>
            @else
            <a href="{{route('admin.setting.document')}}">{{__('admin/setting.document_title')}}</a>
            @endif
            </label>
        </div>

        @if($user->hasMenu('admin.setting.delay'))
        <div class="form-check form-check-danger">
            <label class="form-check-label">
            <i class="fa fa-clock-o text-param-ora icon-sm"></i>
            @if( $routeName == 'admin.setting.delay')
            <strong>{{__('admin/navigation.delay')}}</strong>
            @else
            <a href="{{route('admin.setting.delay')}}">{{__('admin/navigation.delay')}}</a>
            @endif
            </label>
        </div>
        @endif

        @if($user->hasMenu('admin.setting.currency'))
        <div class="form-check form-check-danger">
            <label class="form-check-label">
            <i class="fa fa-money text-param-ora icon-sm"></i>
            @if( $routeName == 'admin.setting.currency'  )
            <strong>{{__('admin/navigation.currency')}}</strong>
            @else
            <a href="{{route('admin.setting.currency')}}">{{__('admin/navigation.currency')}}</a>
            @endif 
            </label>
        </div>
        @endif
    </div>
</div>