<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container px-6 py-8 mx-auto">
                <h3 class="text-3xl font-medium text-gray-700">Welcome : {{ auth()->user()->name }}</h3>
                <div class="p-5 my-6 bg-white rounded shadow-md">
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="font-medium text-gray-700 select-none">User Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="Enter name"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="email" class="font-medium text-gray-700 select-none">Email</label>
                            <input id="email" type="text" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="Enter email"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex mt-5 text-gray-500">
                            <div class="bg-white rounded-lg">
                                <div class="" x-data="imageData()">
                                    <div x-show="previewUrl == '' && imgurl == ''">
                                        <p class="text-center uppercase text-bold">
                                            <label for="thumbnailprev" class="cursor-pointer">
                                                Upload a file
                                            </label>
                                            <input type="file" name="profile" id="thumbnailprev"
                                                class="hidden thumbnailprev" @change="updatePreview()">
                                        </p>
                                    </div>
                                    <div x-show="previewUrl !== ''" class="relative w-24 h-24">
                                        <img :src="previewUrl" alt=""
                                            class="object-cover w-full h-auto h-full max-w-full align-middle border-none rounded-full shadow-lg">
                                        <div class="ml-5">
                                            <button type="button" class=""
                                                @click="clearPreview()">change</button>
                                        </div>
                                    </div>

                                    <div x-show="imgurl !== ''" class="relative w-24 h-24">
                                        <img :src="imgurl" alt=""
                                            class="object-cover w-full h-auto h-full max-w-full align-middle border-none rounded-full shadow-lg">
                                        <div class="ml-5">
                                            <button type="button" class=""
                                                @click="clearPreview()">change</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-16 mb-16 text-center">
                            <button type="submit"
                                class="px-5 py-1 font-bold text-white transition-colors bg-blue-500 rounded shadow focus:outline-none hover:bg-blue-500 ">Update</button>
                            <button type="button" onclick="window.location='{{ route('admin.dashboard') }}'"
                                class="px-5 py-1 ml-2 font-bold text-white transition-colors bg-red-500 rounded shadow focus:outline-none hover:bg-red-600">Cancel</button>
                        </div>
                </div>
            </div>
    </div>
    </main>
    </div>
    </div>


    <script>
        function imageData() {
            var files = document.getElementById("thumbnailprev").files;
            if (files.length == 0) {
                var url = '/images/' + {!! json_encode($user->profile) !!};
            } else {
                url = '';
            }
            return {
                previewUrl: "",
                imgurl: url,
                updatePreview() {
                    var reader, files = document.getElementById("thumbnailprev").files;
                    reader = new FileReader();
                    reader.onload = e => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                },
                clearPreview() {
                    document.getElementById("thumbnailprev").value = null;
                    this.previewUrl = "";
                    this.imgurl = "";
                }
            };
        }
    </script>
</x-app-layout>
