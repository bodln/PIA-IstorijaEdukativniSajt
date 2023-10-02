<x-layout>
    <div style="widows: 100%; display: flex; justify-content:center; align-items:center; min-height: 100vh;">
        <div style="min-height: 60vh;">
            <x-card class="p-10">

                <header>
                    <h1 class="text-3xl text-center font-bold my-6 uppercase">
                        Upravljanje Zahtevima
                    </h1>
                </header>

                <table class="w-full table-auto rounded-sm">
                    <tbody>
                        @unless ($notifications->isEmpty())
                        @foreach ($notifications as $notification)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $notification->title }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <span class="text-gray-500 italic">{{ $notification->created_at }}</span>
                            </td>                            
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                               
                                <form method="POST" action="/notifications/{{ $notification->id }}/accept">
                                    @csrf
                                    <button type="submit"><i class="fa-solid fa-pencil"></i> Prihvati</button>
                                </form>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form method="POST" action="/notifications/{{ $notification->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500"><i class="fa-solid fa-trash"></i>Briši</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <p class="text-center">Nema pronađenih zahteva</p>
                            </td>
                        </tr>
                        @endunless

                    </tbody>
                </table>
                <div class="mt-6 p-4">
                    {{ $notifications->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-layout>