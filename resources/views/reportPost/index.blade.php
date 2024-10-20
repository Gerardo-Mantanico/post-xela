<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        <div class="bg-gray-200   w-full   p-6 flex justify-center items-center">
          <h1 class="text-center mt-6">Report post</h1>
        </div>

        <div class="relative mt-12 flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
          <table class="w-full text-center table-auto min-w-max p-6">
            <thead>
              <tr class="border-b border-slate-300 bg-slate-50">
                <th class="p-4 text-sm font-normal leading-none text-slate-500">Id post</th>
                <th class="p-4 text-sm font-normal leading-none text-slate-500">cause</th>
                <th class="p-4 text-sm font-normal leading-none text-slate-500">APPROVED</th>
                <th class="p-4 text-sm font-normal leading-none text-slate-500">REFUSED</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($report as $item)
              <tr class="hover:bg-slate-50">
                <td class="p-4 text-sm font-normal leading-none text-slate-500">{{ $item->id_report}}</td>
                <td class="p-4 text-sm font-normal leading-none text-slate-500">
                  <div class="max-w-[400px]">
                    <p class="text-sm text-slate-500 break-words text-left ">{{ $item->cause }}</p>
                  </div>
                </td>
                <td class="p-4 text-sm font-normal leading-none text-slate-500">
                  <a class="text-slate-500 hover:text-slate-700">
                    <svg class="h-6 w-6 text-green-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <polyline points="9 11 12 14 20 6" />
                      <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                    </svg>
                  </a>
                </td>
                <td class="p-4 py-5">
                  <form action="" method="POST">
                    @csrf
                    @method('DELETE') <!-- Aquí especificas que la solicitud es DELETE -->
                    <button type="submit" class="text-slate-500 hover:text-slate-700">
                      <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
                        <line x1="18" y1="9" x2="12" y2="15" />
                        <line x1="12" y1="9" x2="18" y2="15" />
                      </svg>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>