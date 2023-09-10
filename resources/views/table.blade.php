<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <nav class="mt-5">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach ($shops as $shop=>$d)
                        <button  class="nav-link" data-bs-toggle="tab" data-bs-target="#shop{{$shopslist[$shop]}}" aria-controls="shop{{$shopslist[$shop]}}" role="tab" aria-current="page">{{$shop}}</button >
                    @endforeach
                </div>
            </ul>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Фильтр</button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form action="" class="mb-3">
                                    <select class="mb-1 w-100" name="cats[]" class="form-select" multiple aria-label="Multiple select example">
                                        <?php foreach ($filter['categories'] as $categories):?>
                                        <option value="<?=$categories->id?>" <?=($categories['active'] == 1 ? 'selected' : '')?>><?=$categories->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="tab-content" id="nav-tabContent">
                @foreach ($shops as $shop=>$d)
                    <div class="tab-pane fade" id="shop{{$shopslist[$shop]}}" role="tabpanel" tabindex="0">
                        <table class="table table-bordered mb-5 mt-5">
                            <tbody>
                            @foreach ($d as $name=>$item)
                                <tr>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['quantity']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
    </html>
