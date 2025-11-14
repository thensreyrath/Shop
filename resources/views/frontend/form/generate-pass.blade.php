@extends('frontend.layout')
@section('title')
    Generate Password
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="generate-form-wrapper">
                <div class="generate-form">
                     <div class="card">
                    <div class="card-body">
                        <h5 class="title">Change Password</h5>
                        <form action="{{ route('change-pass') }}" method="POST">
                            @csrf
                           
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="password" class="col-form-label">Password</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">
                                   
                                </div>
                                {{-- <div class="col-auto">
                                    <span id="passwordHelpInline" class="form-text">Must be 8-20 characters long. </span>
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-success mt-2" name="generate">Generate</button>
                            
                             @if (Session::has('password'))
                                <div class="input-group input-group-merge mt-2 ">
                                    <span class="input-group-text copy-link-button" >{{ Session::get('password') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" >
                                            <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z"/>
                                        </svg>
                                        
                                    </span>
                                </div>
                                <p class="text-danger text-center"></p>
                            @endif
                            @error('password')
                                <span class="input-group-text copy-link-button span-copy-link" id="copyText" onclick="copyToClipboard()">
                                    {{ $message }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z"/>
                                    </svg>
                                    <span class="copy-message" id="copyMessage">Copied!</span>
                                </span>
                            @enderror
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        function copyToClipboard(text) {
            const messageElement = document.getElementById('copyText');
            const textToCopy = messageElement.innerText;

            navigator.clipboard.writeText(textToCopy).then(() => {
                const message = document.getElementById('copyMessage');
                message.style.display = 'block';
                setTimeout(() => {
                    message.style.display = 'none';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }
    </script>
@endsection
