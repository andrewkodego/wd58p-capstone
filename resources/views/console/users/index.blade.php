<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    @if(session('status') != '')
    <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="bg-emerald-200 py-[6px] px-[10px] rounded text-sm text-gray-600">{{ session('status') }}</p>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-4 mb-[15px]">
                        <form>
                            <div class="grid grid-cols-2 gap-4">
                                <x-text-input name="name" type="text" value="{{ app('request')->input('name') }}" class="mt-1 block w-full" placeholder="Search by user name"/>
                                <div class="mt-1">
                                    <x-primary-button class="py-[12px]">{{ __('Search')}}</x-primary-button>
                                </div>
                            </div>
                        </form>
                        <div class="text-right">
                            <x-primary-button class="py-[12px]" onclick="gotoAdd()"><i class="fa fa-plus"></i>{{ __('Add')}}</x-primary-button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="w-[100%]">
                            <thead>
                                <tr>
                                    <th class="th-header">ID</th>
                                    <th class="th-header">Name</th>
                                    <th class="th-header">Email</th>
                                    <th class="th-header">Status</th>
                                    <th class="th-header">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userList as $user)
                                <tr>
                                    <td class="td-row text-right">{{ $user->id }}</td>
                                    <td class="td-row">{{ $user->name }}</td>
                                    <td class="td-row">{{ $user->email }}</td>
                                    <td class="td-row">{{ $user->statusName }}</td>
                                    <td class="td-row">
                                        <div class="flex items-center gap-4"> 
                                            <x-primary-button onclick="gotoEdit({{ $user->id}})">{{ __('Edit')}}</x-primary-button>
                                            <form method="POST" action="{{ route('users.destroy',$user->id) }}">
                                                @csrf
                                                @method('delete')
                                                <x-danger-button>{{ __('Delete')}}</x-danger-button>
                                            </form>
                                            @if($user->isDeleted)
                                            <form method="POST" action="{{ route('users.restore',$user->id) }}">
                                                @csrf
                                                <x-danger-button>{{ __('Restore')}}</x-danger-button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>                                
                        </table>
                    </div>  

                    <x-pagination :resultList="$userList"/>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const gotoEdit = (id) => {
        window.location.href=`/manage/users/${id}/edit`;
    }

    const gotoAdd = () =>{
        window.location.href=`/manage/users/create`;
    }
</script>