<x-guest-layout>
    <div class="w-full max-w-md px-2 py-4 bg-white border border-gray-200 shadow-xl sm:rounded-xl mt-16 z-[1]">
        
        {{-- 1. BLOCk DA IMAGEM (Coruja) --}}
        <div class="w-full flex justify-center"> 
            {{-- Uso de w-full e justify-center para centralizar a imagem --}}
            <img class="w-56 h-auto max-h-96 object-contain -mt-24 mb-2" src="/img/Coruja Estudiosa com Óculos e Livro 2.svg" alt="Imagem do mascote do site">
        </div>

        {{-- 2. TÍTULO DE BOAS-VINDAS --}}
        <h1 class="text-2xl font-extrabold text-center text-[#16a24b]">{{ __('Bem-Vindo ao SoftLearn') }}</h1>
        
        <div class="flex flex-col items-center">
            {{-- 3. FORMULÁRIO (Centralizado) --}}
            <div class="w-full max-w-md bg-white overflow-hidden p-6">
                
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    {{-- CAMPOS DE EMAIL E SENHA (Mantidos) --}}
                    <div>
                        <x-input-label class="text-custom-dark font-inter" for="email" :value="__('Email:')" />
                        <x-text-input id="email" 
                                      class="block mt-1 w-full border-custom-input focus:border-[#16a24b] text-custom-dark font-inter" 
                                      type="email" 
                                      name="email" 
                                      :value="old('email')" 
                                      required autofocus 
                                      autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label class="text-custom-dark font-inter" for="password" :value="__('Senha:')" />
                        <x-text-input id="password" 
                                      class="block mt-1 w-full border-custom-input focus:border-[#16a24b] text-custom-dark font-inter"
                                      type="password"
                                      name="password"
                                      required 
                                      autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-custom-texto font-inter">{{ __('Lembre-se de mim') }}</span>
                        </label>
                    </div>
                    
                    {{-- Botão de Login Customizado --}}
                    <div class="flex items-center justify-center mt-6">
                        <button type="submit" class="w-full sm:w-auto bg-[#16a24b] text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-gray-800 transition-colors">
                            {{ __('Acessar') }}
                        </button>
                    </div>
                    
                    {{-- Links de Ação (Esqueceu a Senha e Criar Conta) --}}
                    <div class="flex items-center justify-between mt-4 text-sm">
                         @if (Route::has('password.request'))
                             <a class="text-custom-texto hover:text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-inter" href="{{ route('password.request') }}">
                                 {{ __('Esqueceu a senha?') }}
                             </a>
                         @endif
                        
                         <a class="text-[#1A01FD] hover:text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-inter" href="{{ route('register') }}">
                             {{ __('Criar conta') }}
                         </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
    

    <div class="fixed bottom-[-70px] w-full z-0"> 

    
        <svg id="bg-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path id="bg-svg-path" fill="#16a24b" fill-opacity="1" d="M0,128L48,154.7C96,181,192,235,288,234.7C384,235,480,181,576,186.7C672,192,768,256,864,266.7C960,277,1056,235,1152,202.7C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>

</x-guest-layout>