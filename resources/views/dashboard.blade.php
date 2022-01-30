<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>

    <div id="toast-default"
         class="absolute top-5 right-5 flex items-center w-full max-w-xs p-4 divide-gray-200 rounded-lg shadow text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
         role="alert">
      <div
          class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd"></path>
        </svg>
      </div>
      <div class="ml-3 text-sm font-normal">Set yourself free.</div>

      <button type="button"
              class="float-right ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
              data-collapse-toggle="toast-default" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>

  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">


          <div
              class="p-4 w-full text-center bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h3 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">You're logged in!</h3>
            <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Klik auto Nomor hp dan Provider akan
              otomatis terisi dan akan ada generate 500 random No hp random Provider</p>
            <div class="justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
              <a href="#"
                 class="w-full sm:w-auto flex bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="mr-3 w-7 h-7" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="apple"
                     role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                  <path fill="currentColor"
                        d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"></path>
                </svg>
                <div class="text-left">
                  <div class="mb-1 text-xs">Download on the</div>
                  <div class="-mt-1 font-sans text-sm font-semibold">Mac App Store</div>
                </div>
              </a>
              <a href="#"
                 class="w-full sm:w-auto flex bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="mr-3 w-7 h-7" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-play"
                     role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="currentColor"
                        d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"></path>
                </svg>
                <div class="text-left">
                  <div class="mb-1 text-xs">Get in on</div>
                  <div class="-mt-1 font-sans text-sm font-semibold">Google Play</div>
                </div>
              </a>
            </div>
          </div>

          <!-- Two columns -->
          <div class="flex flex-row mb-4">
            <div class="basis-1/4">
              <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <div class="px-6 py-4">
                  <div class="font-bold text-xl mb-2">Data No Handphone</div>
                  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        No Handphone
                      </label>
                      <input
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          id="phone-number" type="text" placeholder="No Handphone">
                    </div>
                    <div class="mb-6">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="provider">
                        Provider
                      </label>
                      <div class="relative">
                        <select
                            class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline capitalize"
                            id="provider">
                          @foreach ($providers as $provider)
                            <option value="{{ $provider }}">{{ $provider }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="flex items-center justify-between">
                      <button
                          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                          type="button">
                        Save
                      </button>
                      <button
                          class="bg-indigo-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                          type="button">
                        Auto
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="basis-1/4">
              <div class="flex justify-center mt-4">
                <h3>--->>> Proses --->>></h3>
              </div>
            </div>

            <div class="basis-1/2">
              <div class="max-w-sm rounded shadow-lg px-2 py-2">
                <div class="px-2 py-4">
                  <div class="font-bold text-xl mb-3">Output</div>
                  <div class="flex flex-row">
                    <div class="-my-2 overflow-hidden sm:-mx-6 lg:-mx-8">
                      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                          <table class="min-w-full border-collapse border border-slate-400">
                            <thead class="bg-gray-50">
                            <tr>
                              <th scope="col"
                                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-slate-300">
                                Ganjil
                              </th>
                              <th scope="col"
                                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-slate-300">
                                Genap
                              </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap border border-slate-300">
                                0812-8880-9801
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap border border-slate-300">
                                0812-8880-9802
                              </td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>
