
<x-app-layout>
@section('header', 'Welcome Page')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div id="login-container">
                    <input type="text" id="email-input">Enter email</input>
                    <a id="verify-button" data-route="{{url('send-code')}}">Get verification code!</a>
                </div>
                <div class="p-6 bg-white border-gray-200" id="instruction-image">
                    Explanation image
                </div>
                <div>
                    <a id="start-quiz" href="{{ url('/quiz/') }}">Start Quiz</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>