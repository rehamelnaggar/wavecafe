<div id="special" class="tm-page-content">
    @foreach ($specialItems as $item)
        <div class="tm-black-bg tm-special-item">
            <img src="{{ asset('assets/img/' . $item->image) }}" alt="{{ $item->name }}">
            <p>{{ asset('assets/img/' . $item->image) }}</p> 
            <div class="tm-special-item-description">
                <h2 class="tm-text-primary tm-special-item-title">{{ $item->name }}</h2>
                <p class="tm-special-item-text">{{ $item->description }}</p>  
            </div>
        </div>
    @endforeach
</div>











              