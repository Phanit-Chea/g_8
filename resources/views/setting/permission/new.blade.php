<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container px-6 py-1 mx-auto">
              <div class="p-5 my-6 bg-white rounded shadow-md">
                <form method="POST" action="{{ route('admin.permissions.store')}}">
                  @csrf
                  @method('post')
                <div class="flex flex-col space-y-2">
                  <label for="role_name" class="font-medium text-gray-700 select-none">Permission Name</label>
                  <input
                    id="role_name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter permission"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200"
                  />
                </div>
                <div class="mt-16 text-center">
                  <button type="submit" class="px-5 py-1 font-bold text-white transition-colors bg-blue-500 rounded shadow focus:outline-none hover:bg-blue-500 ">Submit</button>
                  <button type="button" onclick="window.location='{{ route('admin.dashboard') }}'"
                  class="px-5 py-1 ml-2 font-bold text-white transition-colors bg-red-500 rounded shadow focus:outline-none hover:bg-red-600">Cancel</button>

                </div>
              </div>
            </div>
        </main>
    </div>
</div>
</x-app-layout>
