<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container px-6 py-1 pb-16 mx-auto">
              <div class="p-5 my-6 bg-white rounded shadow-md">
                <form method="POST" action="{{ route('admin.posts.store') }}">
                  @csrf
                  <div class="flex flex-col space-y-2">
                    <label for="title" class="font-medium text-gray-700 select-none">Title</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}"
                      placeholder="Enter title" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
        
                <div class="flex flex-col space-y-2">
                    <label for="description" class="font-medium text-gray-700 select-none">Description</label>
                    <textarea name="description" id="description" placeholder="Enter description" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" rows="5">{{ old('description') }}</textarea>
                </div>
    
                <h3 class="my-4 text-xl text-gray-600">Role</h3>
                <div class="grid grid-cols-3 gap-4">
                  <div class="relative inline-flex">
                    <svg class="absolute top-0 right-0 w-2 h-2 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                    <select class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none" name="publish">
                      <option value="0">Draft</option>
                      <option value="1">Publish</option>
                    </select>
                  </div>
                </div>
                <div class="mt-16 mb-16 text-center">
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
