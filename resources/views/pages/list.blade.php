@extends('layout')

@section('content')
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col space-y-8 items-center w-full max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900 underline">
                {{ $title }}
            </h2>
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                    foreach ($list as $item)
                    {
                        echo '<pre>';
                        var_dump($item);
                        echo '</pre>';
                    }
                ?>
            </div>
        </div>
    </div>
@endsection()