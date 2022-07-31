<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>URL SHORTENER</h1>

        <div class="card">
            <div class="card-header">
                <form action="{{ route('link.store') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="link" class="form-control" placeholder="Insira o link">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Gerar URL</button>
                        </div>
                        
                    </div>
                    @if ($errors->has('link'))
                        <div class="form-text">{{ $errors->first('link') }}</div>
                    @endif
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col">ID</th>
                            <th class="col">Url curta</th>
                            <th class="col">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($message = Session::get('message'))
                        <div class="alert alert-{{ $message['type'] }}">
                            <p>{{ $message['text'] }}</p>
                        </div>
                        @php Session::forget('message') @endphp
                        @endif
                        @foreach ($shortLinks as $shortLink)
                        <tr>
                            <th scope="row">{{ $shortLink->id }}</th>
                            <td>
                                <a href="{{ route('link.find', $shortLink->short_url) }}" target="_blank">
                                    {{ route('link.find', $shortLink->short_url) }}
                                </a>
                            </td>
                            <td>{{ $shortLink->link }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>