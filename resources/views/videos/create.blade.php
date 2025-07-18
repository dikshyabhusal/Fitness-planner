<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">Upload Exercise Video</h2>

        <!-- Uploading Timer + Progress -->
        <div id="uploadingStatus" class="hidden text-center text-green-600 mb-4 font-semibold">
            ⏳ Uploading... <span id="timer">0</span> sec |
            <span id="percentage">0%</span> completed
            <div class="w-full bg-gray-300 rounded mt-2">
                <div id="progressBar" class="bg-green-500 text-xs leading-none py-1 text-center text-white rounded" style="width: 0%">0%</div>
            </div>
        </div>

        <form id="videoUploadForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Title" class="w-full p-2 border rounded mb-4" required>
            <textarea name="description" placeholder="Description" class="w-full p-2 border rounded mb-4"></textarea>
            <input type="file" name="video" id="videoInput" class="mb-4" required>
            <input type="text" name="body_part" placeholder="Body Part (e.g. Chest)" class="w-full p-2 border rounded mb-4" required>
            <input type="text" name="goal" placeholder="Goal (e.g. Weight Loss)" class="w-full p-2 border rounded mb-4" required>
            <input type="number" name="duration" placeholder="Duration in minutes" class="w-full p-2 border rounded mb-4" required>

            <button type="submit" id="uploadBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
        </form>
    </div>

    <script>
        const form = document.getElementById('videoUploadForm');
        const uploadingStatus = document.getElementById('uploadingStatus');
        const timerSpan = document.getElementById('timer');
        const percentageSpan = document.getElementById('percentage');
        const progressBar = document.getElementById('progressBar');
        const uploadBtn = document.getElementById('uploadBtn');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('videos.store') }}", true);

            let seconds = 0;
            let interval = setInterval(() => {
                if (seconds >= 100) {
                    clearInterval(interval);
                }
                timerSpan.textContent = ++seconds;
            }, 1000);

            uploadingStatus.classList.remove('hidden');
            uploadBtn.disabled = true;

            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    percentageSpan.textContent = percent + "%";
                    progressBar.style.width = percent + "%";
                    progressBar.textContent = percent + "%";
                }
            };

            xhr.onload = function () {
                clearInterval(interval);
                if (xhr.status === 200 || xhr.status === 302) {
                    progressBar.classList.remove("bg-green-500");
                    progressBar.classList.add("bg-blue-500");
                    progressBar.textContent = "Upload complete!";
                    setTimeout(() => {
                        window.location.href = "{{ route('videos.index') }}";
                    }, 1500);
                } else {
                    alert("Upload failed!");
                    uploadBtn.disabled = false;
                }
            };

            xhr.onerror = function () {
                clearInterval(interval);
                alert("Upload failed. Check your network.");
                uploadBtn.disabled = false;
            };

            xhr.send(formData);
        });
    </script>
</x-app-layout>
