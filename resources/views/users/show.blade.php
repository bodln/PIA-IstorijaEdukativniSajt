<x-layout>
    <div style="widows: 100%; display: flex; justify-content:center; align-items:center; min-height: 100vh;">
        <div style="min-height: 60vh;">
            <x-card class="p-10">

                <header>
                    <h1 class="text-3xl text-center font-bold my-6 uppercase">
                        Upravljanje Korisnicima
                    </h1>
                </header>

                <table class="w-full table-auto rounded-sm">
                    <tbody>
                        @unless ($users->isEmpty())
                        @foreach ($users as $user)
                        @if($user->id != auth()->user()->id)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $user->name }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                @if($user->role == 'teacher')
                                Profesor
                                @elseif ($user->role == 'student')
                                Učenik
                                @else
                                Admin
                                @endif
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form method="POST" action="/users/{{ $user->id }}/teacher">
                                    @csrf
                                    <button type="submit">
                                        @if ($user->role == 'teacher')
                                        <i class="fa-solid fa-xmark text-red-500"></i> Profesor
                                        @else
                                        <i class="fa-solid fa-check text-green-500"></i> Profesor
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form method="POST" action="/users/{{ $user->id }}/admin">
                                    @csrf
                                    <button type="submit">
                                        @if ($user->role == 'admin')
                                        <i class="fa-solid fa-xmark text-red-500"></i> Admin
                                        @else
                                        <i class="fa-solid fa-check text-green-500"></i> Admin
                                        @endif
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @else
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p class="text-center">Nema pronađenih korisnika</p>
                            </td>
                        </tr>
                        @endunless

                    </tbody>
                </table>
                <div class="mt-6 p-4">
                    {{ $users->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-layout>