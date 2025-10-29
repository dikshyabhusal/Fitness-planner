<x-app-layout>
<div class="min-h-screen bg-gradient-to-b from-[#141e30] via-[#243b55] to-[#0f2027] text-white font-[Inter] py-12">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-extrabold text-purple-300 mb-6">🔎 Results for “{{ $query }}”</h2>

        @if(empty($results) || count($results) === 0)
            <p class="text-gray-300">No relevant results found. Try different keywords.</p>
        @else
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($results as $item)
                    <div class="bg-white/10 rounded-xl p-5 shadow-lg">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-purple-200">
                                    @if($item instanceof \App\Models\WorkoutPlan)
                                        {{ $item->title }}
                                    @elseif($item instanceof \App\Models\DietCategory)
                                        {{ $item->goal }} — {{ $item->target_area }}
                                    @elseif($item instanceof \App\Models\Exercise)
                                        {{ $item->title }}
                                    @elseif($item instanceof \App\Models\ExerciseVideo)
                                        {{ $item->title }}
                                    @else
                                        {{ $item->title ?? ($item->goal ?? 'Untitled') }}
                                    @endif
                                </h3>

                                @if(isset($item->description) && $item->description)
                                    <p class="text-gray-300 mt-2">{{ \Illuminate\Support\Str::limit($item->description, 120) }}</p>
                                @endif
                            </div>
                            <div class="text-right text-sm text-gray-400">
                                Relevance: {{ round(($item->relevance_score ?? 0) * 100, 1) }}%
                                <div class="mt-2">
                                    @if($item instanceof \App\Models\WorkoutPlan)
                                        <a href="{{ route('student.workout_plans.index') }}" class="text-purple-400">Open Plan →</a>
                                    @elseif($item instanceof \App\Models\DietCategory)
                                        <a href="{{ route('diet.categories') }}" class="text-purple-400">View Diet →</a>
                                    @elseif($item instanceof \App\Models\Exercise)
                                        <a href="{{ route('exercises.show', $item->id) }}" class="text-purple-400">View Exercise →</a>
                                    @elseif($item instanceof \App\Models\ExerciseVideo)
                                        <a href="{{ route('videos.index') }}" class="text-purple-400">Watch Video →</a>
                                    @else
                                        <a href="#" class="text-purple-400">Open →</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</x-app-layout>
