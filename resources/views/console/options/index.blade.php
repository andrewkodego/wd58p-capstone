<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Options') }}
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
                                <x-text-input name="name" type="text" value="{{ app('request')->input('name') }}" class="mt-1 block w-full" placeholder="Search by name"/>
                                <div class="mt-1">
                                    <x-primary-button class="py-[12px]">{{ _('Search')}}</x-primary-button>
                                </div>
                            </div>
                        </form>
                        <div class="text-right">
                            <x-primary-button class="py-[12px]" onclick="gotoAdd()"><i class="fa fa-plus"></i>{{ _('Add')}}</x-primary-button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="w-[100%]">
                            <thead>
                                <tr>
                                    <th class="th-header">ID</th>
                                    <th class="th-header">Name</th>
                                    <th class="th-header">Description</th>
                                    <th class="th-header">Group Name</th>
                                    <th class="th-header">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultList as $option)
                                <tr>
                                    <td class="td-row text-right">{{ $option->id }}</td>
                                    <td class="td-row">{{ $option->name }}</td>
                                    <td class="td-row">{{ $option->description }}</td>
                                    <td class="td-row">{{ $option->optionGroup->name }}</td>
                                    <td class="td-row">
                                        <div class="flex items-center gap-4"> 
                                            <x-primary-button onclick="gotoEdit({{ $option->id}})">{{ _('Edit')}}</x-primary-button>
                                            <form method="POST" action="{{ route('options.destroy',$option->id) }}">
                                                @csrf
                                                @method('delete')
                                                <x-danger-button>{{ __('Delete')}}</x-danger-button>
                                            </form>
                                            @if($option->isDeleted)
                                            <form method="POST" action="{{ route('options.restore',$option->id) }}">
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

                    <x-pagination :resultList="$resultList"/>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const gotoEdit = (id) => {
        window.location.href=`/options/${id}/edit`;
    }

    const gotoAdd = () =>{
        window.location.href=`/options/create`;
    }
</script>