<nav class="main_nav">
    <a href="{{ route('home') }}" >Home</a>
    <a href="{{ route('posts.index') }}">Posts</a>
    <a href="{{ route('posts.create') }}" >Create post</a>
    <a href="{{ route('info') }}" >Info</a>
    <a href="{{ route('profile.show') }}" >Profile</a>
    @auth("web")
        <a href="{{ route('logout') }}" >Sign out </a>
    @endauth

    @guest("web")
        <a href="{{ route('login') }}" >Sign in </a>
    @endguest
</nav>
