<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Articles') }}
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
                                <x-text-input name="title" type="text" value="{{ app('request')->input('title') }}" class="mt-1 block w-full" placeholder="Search by title"/>
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
                                    <th class="th-header" style="width:5%">ID</th>
                                    <th class="th-header" style="width:30%">Excerpt</th>
                                    <th class="th-header" style="width:20%">Author</th>
                                    <th class="th-header" style="width:15%">Status</th>
                                    <th class="th-header" style="width:15%">Created Date</th>
                                    <th class="th-header" style="width:15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articleList as $article)
                                <tr>
                                    <td class="td-row text-right">{{ $article->id }}</td>
                                    <td class="td-row">{{ $article->excerpt }}</td>
                                    <td class="td-row">{{ $article->authorName }}</td>
                                    <td class="td-row">{{ $article->statusName }}</td>
                                    <td class="td-row">{{ $article->createdDate }}</td>
                                    <td class="td-row">
                                        <div class="flex items-center gap-4"> 
                                            @if($article->canEditRecord('articles.index'))
                                            <x-primary-button onclick="gotoEdit({{ $article->id}})">{{ __('Edit')}}</x-primary-button>
                                            @else
                                            <x-primary-button class="bg-[#cccccc]">{{ __('Edit')}}</x-primary-button>
                                            @endif
                                            @if($article->canDeleteRecord('articles.index'))
                                            <x-delete-restore :id="$article->id" :isDeleted="$article->isDeleted"
                                                :action="$article->isDeleted ? route('articles.restore',$article->id) : route('articles.destroy',$article->id)" 
                                                deleteLabel="Archive"
                                                restoreLabel="Activate"/>
                                            @else
                                            <x-danger-button class="bg-[#cccccc]">{{ __('Archive')}}</x-danger-button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>                                
                        </table>
                    </div>  

                    <x-pagination :resultList="$articleList"/>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const gotoEdit = (id) => {
        window.location.href=`/articles/${id}/edit`;
    }

    const gotoAdd = () =>{
        window.location.href=`/articles/create`;
    }
</script>