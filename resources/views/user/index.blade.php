<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <ul class="uk-iconnav uk-margin">
        <li>
            <a href="#modal-center" class="mx-2" uk-toggle="target: #import-user" uk-icon="icon: download"></a>
            @include('user.import-user')
        </li>
    </ul>

    @if (session('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    <ul uk-tab>
        <li class="uk-active"><a href="#">Guru</a></li>
        <li class="uk-active"><a href="#">Siswa</a></li>
        <li class="uk-active"><a href="#">Walmur</a></li>
    </ul>
    
    <ul class="uk-switcher uk-margin">  
        <li class="uk-active">
            @include('user.guru')
        </li> 
        <li class="uk-active">
            @include('user.siswa')
        </li>
        <li class="uk-active">
            @include('user.walmur')
        </li>
    </ul>


    
</x-admintemplate>