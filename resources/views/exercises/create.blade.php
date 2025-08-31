<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-10">
        <div class="bg-white shadow-xl rounded-2xl p-10 border border-gray-100">

            <!-- Heading -->
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Upload New Exercise</h2>
            <p class="text-gray-500 mb-10">Provide details below to add a new exercise. Organized sections will guide you step by step.</p>

            <form method="POST" action="{{ route('exercises.store') }}" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <!-- SECTION 1: Basic Info -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">📌 Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Exercise Title</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 shadow-sm">
                            @error('title') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                            <select name="exercise_category_id"
                                class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 shadow-sm">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('exercise_category_id') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Guidance -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">📝 Guidance</h3>
                    <div class="space-y-5">
                        <!-- Coach Tips -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Coach Tips</label>
                            <textarea name="coach_tips" rows="3"
                                class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 shadow-sm">{{ old('coach_tips') }}</textarea>
                        </div>

                        <!-- Precautions -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Precautions</label>
                            <textarea name="precautions" rows="3"
                                class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 shadow-sm">{{ old('precautions') }}</textarea>
                        </div>

                        <!-- How to Start -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">How to Start</label>
                            <textarea name="how_to_start" rows="3"
                                class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 shadow-sm">{{ old('how_to_start') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: Media -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">🎥 Media Uploads</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Photo -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Exercise Photo</label>
                            <input type="file" name="photo"
                                class="w-full text-gray-700 px-3 py-2 border border-gray-300 rounded-xl cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-400">
                        </div>

                        <!-- Video -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Exercise Video</label>
                            <input type="file" name="video"
                                class="w-full text-gray-700 px-3 py-2 border border-gray-300 rounded-xl cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-400">
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: Submit -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-purple-600 text-white font-semibold py-3 rounded-xl shadow-lg hover:opacity-90 transition duration-300 ease-in-out">
                        🚀 Save Exercise
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
