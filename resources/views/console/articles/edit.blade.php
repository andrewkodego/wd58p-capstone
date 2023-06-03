<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Articles') }}
        </h2>
        <a href="/articles">Back to List</a>
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
                    
                    <form id="record-data" method="post" action="{{ $article->id > 0 ? route('users.update', $article->id) : route('users.store') }}" class="mt-6 space-y-6" onsubmit="return validatePassword()">
                        @csrf
                        @if($article->id > 0)
                            @method('patch')
                        @endif
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <x-input-label for="title" :value="__('Title')"/>
                                <x-text-input id="title" name="title" type="text" value="{{ $article->title }}" class="mt-1 block w-full" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>

                            <div class="col-span-2">
                                <x-input-label for="content" :value="__('Content')"/>
                                <textarea id="content" name="content" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full min-h-[200px]" required row="5">{!! $article->content !!}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('content')"/>
                            </div>

                            <div class="col-span-2">
                            <x-input-label for="excerpt" :value="__('Excerpt')"/>
                                <textarea id="excerpt" name="excerpt" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>{!! $article->excerpt !!}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('excerpt')"/>
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')"/>
                                <select id="status" name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option></option>
                                    @foreach($article->getArticleStatusList() as $status)
                                    <option value="{{$status->id}}" {{ $status->id == $article->status_id ? 'selected' : ''}}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')"/>
                            </div>
                        </div>
                    </form>

                    <div class="flex items-center gap-4 mt-[15px]">
                        <x-primary-button onclick="doCancel()">{{ __('Cancel') }}</x-primary-button>
                        <x-primary-button form="record-data">{{ __('Save') }}</x-primary-button>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const doCancel = () =>{
        window.location.href=`/manage/articles`;
    }
</script>
