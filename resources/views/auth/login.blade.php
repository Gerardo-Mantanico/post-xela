<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
        </x-slot>
      <div class="relative sm:max-w-sm w-full">
          <div class="card bg-black shadow-lg  w-full h-full rounded-l-lg absolute  transform -rotate-6"></div>
          <div class="card bg-black shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
          <div class="relative w-full rounded-3xl  px-6 py-4 bg-white shadow-md">
              <label for="" class="block mt-3 text-sm text-gray-700 text-center font-semibold">
                    <img src="https://i.postimg.cc/DyJgfJ2p/Logo-Fiestas-y-Pi-atas-Divertido-Morado-y-Rosa-Photoroom.png" alt="logo">
              </label>
              <x-validation-errors class="mb-4" />
              @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession
              <form method="POST" action="{{route('login')}}" class="mt-10">                   
                @csrf   
              <div>
                      <input type="email" name="email" :$value="old{'email'}"  required autofocus autocomplete="username"    placeholder="Correo electronico" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-lg shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                  </div>
      
                  <div class="mt-7">                
                      <input type="password" id="password" name="password" placeholder="Contraseña" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">                           
                  </div>

                  <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
                   <div class="mt-7">
                      <div class="flex justify-center items-center">
                          <label class="mr-2" >¿Eres nuevo?</label>
                          <a  href="{{ route('register') }}" class=" text-blue-500 transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                              Crea una cuenta
                              
                          </a>
                      </div>
                  </div>
              </form>
          </div>
      </div>
    </x-authentication-card>
</x-guest-layout>

<!-- This is an example component -->
