<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-[#141e30] via-[#243b55] to-[#0f2027] text-white font-[Inter]">

        {{-- HERO SECTION --}}
        <section class="relative w-full h-[90vh] bg-cover bg-center flex items-center justify-center"
                 style="background-image: url('https://source.unsplash.com/1600x900/?fitness,training');">
            <div class="absolute inset-0 bg-black bg-opacity-70 backdrop-blur-md"></div>
            <div class="relative z-10 px-6 text-center max-w-4xl space-y-6 animate-fade-in">
                <h1 class="text-5xl sm:text-6xl font-[Poppins] font-extrabold leading-snug tracking-tight text-white drop-shadow-lg">
                    Transform Your Body with <br>
                    <span class="text-purple-400 text-6xl sm:text-7xl font-[Oswald] mt-2 block drop-shadow-md">Fitness Planner</span>
                </h1>
                <p class="text-xl sm:text-2xl text-gray-300 leading-relaxed max-w-2xl mx-auto">
                    Your all-in-one platform to build, track, and conquer your workout goals—where science meets sweat.
                </p>
            </div>
        </section>

        <main class="px-6 py-24 space-y-24 w-full">

            <!-- INFO SECTION -->
            <section class="grid md:grid-cols-2 gap-12 items-center max-w-7xl mx-auto">
                <div class="space-y-6">
                    <h2 class="text-4xl font-extrabold text-purple-300">What is Workout Planner?</h2>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        <strong>Workout Planner</strong> is your digital fitness companion. It helps you create personalized fitness routines, track progress, learn correct form, and achieve your goals effectively.
                    </p>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-200">
                        <li class="flex items-start gap-2"><span>✅</span> Custom workout generator</li>
                        <li class="flex items-start gap-2"><span>✅</span> HD exercise tutorials</li>
                        <li class="flex items-start gap-2"><span>✅</span> Trainer-student sharing</li>
                        <li class="flex items-start gap-2"><span>✅</span> Smart body calculators</li>
                    </ul>
                </div>
                <div class="flex justify-center">
                    <img src="{{ asset('storage/about.avif') }}" alt="Workout Info"
                         class="rounded-xl shadow-2xl border-2 border-purple-500 max-w-md hover:scale-105 transition-transform duration-300">
                </div>
            </section>

            <!-- CATEGORIES SECTION -->
            <section class="max-w-7xl mx-auto text-center">
                <h2 class="text-4xl font-extrabold text-purple-300 mb-12">Workout Categories</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach([
                        ['title' => 'Bodybuilding', 'image' => 'body.jpeg', 'slug' => 'bodybuilding'],
                        ['title' => 'Fitness', 'image' => 'fitness.jpeg', 'slug' => 'fitness'],
                        ['title' => 'Cardio', 'image' => 'images.jpeg', 'slug' => 'cardio'],
                        ['title' => 'Pilates', 'image' => 'pilates.jpeg', 'slug' => 'pilates']
                    ] as $category)
                        <a href="{{ route('workout.show', $category['slug']) }}"
                           class="bg-white/10 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 block backdrop-blur-sm">
                            <img src="{{ asset('storage/welcome/' . $category['image']) }}" alt="{{ $category['title'] }}"
                                 class="w-full h-44 object-cover">
                            <div class="p-4 font-semibold text-xl text-purple-200">{{ $category['title'] }}</div>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- STUDENT FEATURE GRID -->
            <section class="text-center max-w-7xl mx-auto pt-20">
                <h1 class="text-5xl font-extrabold tracking-tight mb-4 text-purple-300 animate__animated animate__fadeInDown">
                    🚀Our Features
                </h1>
                <p class="text-lg text-gray-300 animate__animated animate__fadeInUp mb-16">
                    Connect with your favorite features as per your interest and enjoy it.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    @php
    $user = auth()->user();
    $latestDietPlan = $user && $user->dietPlans()->exists() ? $user->dietPlans()->latest('id')->first() : null;

    $features = [
        ['title' => '🍽️ Explore Diet Categories', 'desc' => 'Browse all diet plans by category.', 'link' => route('diet.categories'), 'icon' => 'https://cdn-icons-png.flaticon.com/512/1046/1046784.png'],

        ['title' => '🏋️ My Workout Plans', 'desc' => 'View your assigned workouts.', 'link' => route('student.workout_plans.index'), 'icon' => 'https://cdn-icons-png.flaticon.com/512/833/833472.png'],

        

        ['title' => '🎥 Watch Workout Videos', 'desc' => 'Video tutorials for form.', 'link' => route('videos.index'), 'icon' => 'https://cdn-icons-png.flaticon.com/512/2910/2910768.png'],

        ['title' => '❤️ Saved Workout Plans', 'desc' => 'Bookmarked workouts.', 'link' => route('student.saved.data'), 'icon' => 'https://cdn-icons-png.flaticon.com/512/2589/2589175.png'],

        // ['title' => '🍽️ Saved Diet Plans', 'desc' => 'Saved meal guides.', 'link' => route('videos.index'), 'icon' => 'https://cdn-icons-png.flaticon.com/512/2921/2921823.png'],

        ['title' => '👤 My Trainer', 'desc' => 'See your trainer\'s profile.', 'link' => route('videos.index'), 'icon' => 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png'],
    ];
@endphp


                    @foreach ($features as $item)
                        <div class="bg-white bg-opacity-5 hover:bg-opacity-10 backdrop-blur-md border border-purple-600/20 rounded-3xl p-6 shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                            <div class="flex flex-col items-center text-center">
                                <img src="{{ $item['icon'] }}" alt="{{ $item['title'] }} Icon" class="w-16 h-16 mb-4">
                                <h3 class="text-xl font-bold text-purple-200 mb-2">{{ $item['title'] }}</h3>
                                <p class="text-sm text-gray-300 mb-4">{{ $item['desc'] }}</p>
                                <a href="{{ $item['link'] }}" class="bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition">Explore</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- NEARBY GYMS MAP -->
            <section class="max-w-7xl mx-auto pt-20 px-4">
                <h2 class="text-4xl font-extrabold text-purple-300 mb-8 text-center">Nearby Gyms</h2>
                <div id="map" style="height:400px;" class="w-full rounded-xl shadow-lg border-2 border-purple-500"></div>
                <p id="map-status" class="text-center mt-4 text-gray-300"></p>
            </section>

        </main>
    </div>

    <!-- Leaflet CSS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        crossorigin=""
    />

    <!-- Leaflet JS -->
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        crossorigin=""
    ></script>

    <!-- Leaflet Routing Machine CSS & JS -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css"
    />
    <script
      src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"
    ></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const statusText = document.getElementById('map-status');
            let userLatLng = null;
            let routingControl = null;

            const map = L.map('map').setView([27.7172, 85.324], 13); // Kathmandu center

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Function to add gym markers with popup and routing button
            function addGymMarkers(gyms) {
                gyms.forEach(gym => {
                    const marker = L.marker([gym.lat, gym.lng]).addTo(map);

                    marker.bindPopup(`
                        <strong>${gym.name}</strong><br>
                        <button class="route-btn" style="
                            margin-top:5px;
                            padding:4px 8px;
                            background:#7c3aed;
                            color:#fff;
                            border:none;
                            border-radius:4px;
                            cursor:pointer;
                        ">Get Directions</button>
                    `);

                    marker.on('popupopen', () => {
                        const btn = document.querySelector('.route-btn');
                        if (btn) {
                            btn.onclick = () => {
                                if (!userLatLng) {
                                    alert("User location not available to calculate route.");
                                    return;
                                }

                                if (routingControl) {
                                    map.removeControl(routingControl);
                                }

                                routingControl = L.Routing.control({
                                    waypoints: [
                                        L.latLng(userLatLng.lat, userLatLng.lng),
                                        L.latLng(gym.lat, gym.lng)
                                    ],
                                    routeWhileDragging: false,
                                    showAlternatives: false,
                                    lineOptions: {
                                        styles: [{color: '#7c3aed', weight: 5}]
                                    },
                                    createMarker: () => null,
                                }).addTo(map);

                                // Voice instructions on route found
                                routingControl.on('routesfound', function(e) {
                                    const routes = e.routes;
                                    if (!routes.length) return;

                                    // Cancel any previous speech
                                    window.speechSynthesis.cancel();

                                    const instructions = [];
                                    routes[0].instructions.forEach(instr => {
                                        instructions.push(instr.text);
                                    });

                                    // Function to speak instructions sequentially
                                    let index = 0;
                                    function speakNext() {
                                        if (index >= instructions.length) return;
                                        const utterance = new SpeechSynthesisUtterance(instructions[index]);
                                        utterance.lang = 'en-US';
                                        utterance.rate = 1;
                                        utterance.pitch = 1;
                                        utterance.onend = () => {
                                            index++;
                                            speakNext();
                                        };
                                        window.speechSynthesis.speak(utterance);
                                    }
                                    speakNext();
                                });
                            };
                        }
                    });
                });
            }

            if (navigator.geolocation) {
                statusText.textContent = "Fetching your location...";

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        userLatLng = {lat, lng};
                        map.setView([lat, lng], 14);
                        statusText.textContent = "Showing gyms near you.";

                        L.circleMarker([lat, lng], {
                            radius: 8,
                            fillColor: '#9f7aea',
                            color: '#7c3aed',
                            weight: 2,
                            opacity: 1,
                            fillOpacity: 0.8
                        }).addTo(map).bindPopup("You are here").openPopup();

                        const gyms = [
                            {lat: lat + 0.005, lng: lng + 0.005, name: "Powerhouse Gym"},
                            {lat: lat - 0.006, lng: lng + 0.004, name: "Muscle Factory"},
                            {lat: lat + 0.003, lng: lng - 0.007, name: "FitZone Fitness"},
                            {lat: lat - 0.005, lng: lng - 0.005, name: "Iron Temple Gym"},
                        ];

                        addGymMarkers(gyms);
                    },
                    (error) => {
                        statusText.textContent = "Could not get your location. Showing default area.";

                        const defaultGyms = [
                            {lat: 27.722, lng: 85.316, name: "Powerhouse Gym"},
                            {lat: 27.710, lng: 85.320, name: "Muscle Factory"},
                            {lat: 27.715, lng: 85.310, name: "FitZone Fitness"},
                            {lat: 27.705, lng: 85.305, name: "Iron Temple Gym"},
                        ];

                        addGymMarkers(defaultGyms);
                    }
                );
            } else {
                statusText.textContent = "Geolocation is not supported by your browser.";

                const fallbackGyms = [
                    {lat: 27.722, lng: 85.316, name: "Powerhouse Gym"},
                    {lat: 27.710, lng: 85.320, name: "Muscle Factory"},
                    {lat: 27.715, lng: 85.310, name: "FitZone Fitness"},
                    {lat: 27.705, lng: 85.305, name: "Iron Temple Gym"},
                ];
                addGymMarkers(fallbackGyms);
            }
        });
    </script>

    <style>
        /* Leaflet map container background */
        .leaflet-container {
            background: #0f2027;
            border-radius: 1rem;
        }
        /* Popup style */
        .leaflet-popup-content-wrapper {
            background: #1e293b;
            color: #ddd;
            border-radius: 1rem;
            font-weight: 600;
        }
        .leaflet-popup-tip {
            background: #f0f2f4;
        }

        /* Routing instructions color - changed to black for visibility */
        .leaflet-routing-instruction {
            color: #000000 !important; /* Black text */
            font-weight: 600;
        }
        .leaflet-routing-instruction-distance {
            color: #222222 !important; /* Dark grey distance */
            font-weight: 600;
        }
    </style>

    <!-- Animate.css & Custom Animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 1s ease-out both;
        }
    </style>
</x-app-layout>
