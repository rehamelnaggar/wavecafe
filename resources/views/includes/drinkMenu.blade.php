<nav class="tm-black-bg tm-drinks-nav">
@foreach($categories as $category)
              <ul>
                <li>
                <a href="#"  class="tm-tab-link {{ $loop->first ? 'active' : '' }}"  data-id="cold">{{ $category->name,1 }}</a>
                </li>
                <li>
                <a href="#" class="tm-tab-link {{ $loop->first ? 'active' : '' }}" data-id="hot">{{ $category->name,2 }}</a>
                </li>
                <li>
                <a href="#" class="tm-tab-link {{ $loop->first ? 'active' : '' }}" data-id="juice">{{ $category->name,3 }}</a>
                </li>
              </ul>
            </nav>

            <div id="cold" class="tm-tab-content">
            @foreach($icedCoffee as $drink)
              <div class="tm-list">
                <div class="tm-list-item">          
                <img src="{{ asset('assets/storage/' . $drink->image) }}" alt="{{ $drink->name }}" class="tm-list-item-img">
                    <div class="tm-black-bg tm-list-item-text">
                        <h3 class="tm-list-item-name">{{ $drink->name }}<span class="tm-list-item-price">${{ $drink->price }}</span></h3>
                        <p class="tm-list-item-description">{{ $drink->description }}</p>
                  </div>
                </div>
                @endforeach                 
              </div>
            </div> 

            <div id="hot" class="tm-tab-content">
            @foreach($hotCoffee as $drink)
              <div class="tm-list">
              
                <div class="tm-list-item">          
                <img src="{{ asset('assets/storage/' . $drink->image) }}" alt="{{ $drink->name }}" class="tm-list-item-img">
                    <div class="tm-black-bg tm-list-item-text">
                        <h3 class="tm-list-item-name">{{ $drink->name }}<span class="tm-list-item-price">${{ $drink->price }}</span></h3>
                        <p class="tm-list-item-description">{{ $drink->description }}</p>          
                  </div>
                </div>
                @endforeach          
              </div>
            </div>

            <div id="juice" class="tm-tab-content">
            @foreach($fruitJuice as $drink)
              <div class="tm-list">
                <div class="tm-list-item">          
                <img src="{{ asset('assets/storage/' . $drink->image) }}" alt="{{ $drink->name }}" class="tm-list-item-img">
                    <div class="tm-black-bg tm-list-item-text">
                        <h3 class="tm-list-item-name">{{ $drink->name }}<span class="tm-list-item-price">${{ $drink->price }}</span></h3>
                        <p class="tm-list-item-description">{{ $drink->description }} 
                          .Please <a href="https://www.tooplate.com/contact" rel="nofollow" target="_parent">contact Tooplate</a> if you have anything to ask.</p>                
                  </div>
                </div>
                @endforeach 
              </div>
            </div>
            @endforeach