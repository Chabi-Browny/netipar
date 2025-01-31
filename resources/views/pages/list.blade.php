@extends('layout')

@section('content')
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col space-y-8 items-center w-full">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900 underline">
                {{ $title }}
            </h2>
            <div class="border-2 border-gray-400">
                <table class="table-auto border-collapse border-2 border-gray-400">
                    <thead>
                        <tr>
                            <th class="border-2 border-gray-400 w-6 max-w-8">#</th>
                            <th class="border-2 border-gray-400">name</th>
                            <th class="border-2 border-gray-400">address</th>
                            <th class="border-2 border-gray-400">photo</th>
                            <th colspan="2" class="border-2 border-gray-400">contact</th>
                            <!--<th colspan="2" class="border-2 border-gray-400">action</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 1;
                            $photoInfo = !empty($item['photo']) ? 'yes' : 'no';
                            foreach ($list as $item)
                            {
                        ?>
                            <tr class="text-center">
                                <td class="border-2 border-gray-400 w-6 max-w-8"><?php echo $counter; ?></td>
                                <td class="border-2 border-gray-400"><?php if(!empty($item['name'])) echo $item['name']; ?></td>
                                <td class="border-2 border-gray-400"><?php if(!empty($item['address'])) echo $item['address']; ?></td>
                                <td class="border-2 border-gray-400"><?php echo $photoInfo; ?></td>
                                <td colspan="2" class="border-2 border-gray-400">
                                    <?php
                                        if (!empty($item['contacts']) )
                                        {
                                            ?>
                                                <table class="border-collapse  w-full">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-2 border-gray-400">email</th>
                                                            <th class="border-2 border-gray-400">phone</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach($item['contacts'] as $contact)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td class="border-2 border-gray-400"><?php if(!empty($contact['email'])) echo $contact['email']; ?></td>
                                                                <td class="border-2 border-gray-400"><?php if(!empty($contact['phone'])) echo $contact['phone']; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php
                                        }
                                    ?>
                                </td>
<!--                                <td colspan="2">
                                    <a></a>
                                    <a></a>
                                </td>-->
                            </tr>
                        <?php
                                $counter++;
                            }
                        ?>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection()