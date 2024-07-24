<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container px-6 py-1 mx-auto">
              <div class="p-5 my-6 bg-white rounded shadow-md">
                <p class="mb-4 text-2xl font-bold text-gray-800">Mail Setting</p>
                <form method="POST" action="{{ route('admin.mail.update',$mail->id)}}">
                  @csrf
                  @method('put')

                <div class="flex flex-wrap mb-2 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                      <label class="block mb-2 font-medium select-none tracking-widetext-gray-700" for="grid-first-name">
                        Mail Transport
                      </label>
                      <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border-gray-300 rounded-lg appearance-none focus:outline-none focus:bg-white"  id="mail_transport"
                        type="text"
                        name="mail_transport"
                        value="{{ old('mail_transport',$mail->mail_transport) }}"
                      >
                    </div>

                    <div class="w-full px-3 md:w-1/2">
                      <label class="block mb-2 font-medium select-none tracking-widetext-gray-700" for="grid-last-name">
                        Mail Host
                      </label>
                      <input class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-300 rounded-lg appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="mail_host"
                        type="text"
                        name="mail_host"
                        value="{{ old('mail_host',$mail->mail_host) }}"
                      >
                    </div>
                </div>
                <div class="flex flex-wrap mb-2 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                      <label class="block mb-2 font-medium select-none tracking-widetext-gray-700" for="grid-first-name">
                        Mail Port
                      </label>
                      <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border-gray-300 rounded-lg appearance-none focus:outline-none focus:bg-white"  id="mail_port"
                        type="text"
                        name="mail_port"
                        value="{{ old('mail_port',$mail->mail_port) }}"
                      >
                    </div>

                    <div class="w-full px-3 md:w-1/2">
                      <label class="block mb-2 font-medium select-none tracking-widetext-gray-700" for="grid-last-name">
                        Mail username
                      </label>
                      <input class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-300 rounded-lg appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="mail_username"
                        type="text"
                        name="mail_username"
                        value="{{ old('mail_username',$mail->mail_username) }}"
                      >
                    </div>
                </div>


                <div class="flex flex-wrap mb-2 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                      <label class="block mb-2 font-medium select-none tracking-widetext-gray-700" for="grid-first-name">
                        Mail Password
                      </label>
                      <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border-gray-300 rounded-lg appearance-none focus:outline-none focus:bg-white"  id="mail_password"
                        type="text"
                        name="mail_password"
                        value="{{ old('mail_password',$mail->mail_password) }}"
                      >
                    </div>

                    <div class="w-full px-3 md:w-1/2">
                      <label class="block mb-2 font-medium select-none tracking-widetext-gray-700" for="grid-last-name">
                        Mail Encryption
                      </label>
                      <input class="block w-full px-4 py-3 leading-tight text-gray-700 border border-gray-300 rounded-lg appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        id="mail_encryption"
                        type="text"
                        name="mail_encryption"
                        value="{{ old('mail_encryption',$mail->mail_encryption) }}"
                      >
                    </div>
                </div>

                <div class="flex flex-wrap mb-2 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                      <label class="block mb-2 font-medium select-none tracking-widetext-gray-700" for="grid-first-name">
                        Mail From
                      </label>
                      <input class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border-gray-300 rounded-lg appearance-none focus:outline-none focus:bg-white"  id="mail_from"
                        type="text"
                        name="mail_from"
                        value="{{ old('mail_from',$mail->mail_from) }}"
                      >
                    </div>
                </div>

                <div class="mt-16 text-center">
                  <button type="submit" class="px-5 py-1 font-bold text-white transition-colors bg-blue-500 rounded shadow focus:outline-none hover:bg-blue-500 ">Update</button>
                  <button type="button" onclick="window.location='{{ route('admin.dashboard') }}'"
                  class="px-5 py-1 ml-2 font-bold text-white transition-colors bg-red-500 rounded shadow focus:outline-none hover:bg-red-600">Cancel</button>

                </div>
              </div>


            </div>
        </main>
    </div>
</div>
</x-app-layout>
