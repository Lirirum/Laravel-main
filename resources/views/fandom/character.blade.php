@extends('app')
@section('title', $character['name'] )
@section('content')
@push('styles')
    <link href="{{ asset('css/character.css') }}" rel="stylesheet">
@endpush    

        <!-- Main Content -->
        <div class="content">          
       
            <div class="full-info">
                <h2>Information</h2>
                <!-- Section: Summary -->
                <section id="summary">
                    <h2>Summary</h2>
                    <p>{{ $character['summary'] }}</p>
                </section>

                <!-- Section: Abilities -->
                <section id="abilities">
                <h2>Abilities</h2>
                <ul>
                        @foreach ($character['abilities'] as $ability)
                            <li>{{ $ability }}</li>
                        @endforeach
                    </ul>
                </section>

                <!-- Section: Biography -->
                <section id="biography">
                <h2>Biography</h2>
                <p>{{ $character['biography'] }}</p>
            
                </section>
                
                <!-- Section: Gallery -->
                <section id="gallery">
                    <h2>Gallery</h2>
                    <div class="image-grid">
                    @foreach ($character['gallery'] as $image)
                            <img src="{{ asset('images/character/' . $image) }}" alt="Image of {{ $character['name'] }}">
                        @endforeach
                    </div>
                </section>
            </div>

            <div class="main_info">
          

            <div class="info-box">
                
                <div class="image-container">                  
                <img src="{{ asset('images/character/' . $character['image']) }}" alt="{{ $character['name'] }}">
                </div>    
           
                                 
                <table class="info-details">

                    <tr  class="section-name">
                        <td colspan="2">
                            <section> <h2>{{ $character['name'] }} </h2> </section>
                        </td>    
                    </tr>      
                        

                    <tr class="section-name">
                        <td colspan="2">
                            <section > <h2>Biographical information</h2> </section>
                        </td>    
                    </tr>      
                        
                  
                    <tr>
                        <th>Full Name</th>
                        <td>{{ $character['full-name'] }}</td>
                    </tr>
                    <tr>
                        <th>Satus</th>
                        <td>{{ $character['status'] }}</td>
                    </tr>
                    <tr>
                        <th>Birth</th>
                        <td>{{ $character['birth'] }}</td>
                    </tr>
                    <tr class="section-name">
                        <td colspan="2">
                            <section > <h2>Physical description</h2> </section>
                        </td>    
                    </tr>  
                    <tr>
                        <th>Race</th>
                        <td>{{ $character['race'] }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $character['gender'] }}</td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td>{{ $character['age'] }}</td>
                    </tr>
                  
                    <tr>
                        <th>Height</th>
                        <td>{{ $character['height'] }}</td>
                    </tr>
                    <tr>
                        <th>Hair</th>
                        <td>{{ $character['hair'] }}</td>
                    </tr>
                    <tr>
                        <th>Abilities</th>
                        <td>
                            <ul>
                                @foreach ($character['abilities'] as $ability)
                                    <li>{{ $ability }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    
                </table>

            </div>
            </div>
            </div>
     


 
@endsection
