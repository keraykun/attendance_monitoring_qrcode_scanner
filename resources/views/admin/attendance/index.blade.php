@extends('admin.layout')
@section('content')

@error('room')
<script>
    // Display success message
    Swal.fire({
        icon: 'warning',
        text: "{{ $message }}",
        showConfirmButton: false,
    });
</script>
@enderror

<div class="container-fluid">
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div id="qr-reader" style="width: 600px"></div>
                <script type="text/javascript" src="https://unpkg.com/html5-qrcode"></script>
                <script type="text/javascript">
                    function extractTextFromUrl(decodedText) {
                        const urlParts = decodedText.split('/');
                        const lastPart = urlParts[urlParts.length - 1];
                        return decodeURIComponent(lastPart);
                    }

                    function onScanSuccess(decodedText, decodedResult) {
                        const text = extractTextFromUrl(decodedText);
                        console.log("Text scanned:", text);
                        sendDataToBackend(text);
                    }

                    function sendDataToBackend(scannedText) {
                        $.ajax({
                            url: "{{ route('admin.attendance.store') }}",
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                scanned_text: scannedText
                            },
                            success: function(response) {
                                console.log(response,' : from the backend');
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }

                    var html5QrcodeScanner = new Html5QrcodeScanner(
                        "qr-reader", { fps: 10, qrbox: 250 });
                    html5QrcodeScanner.render(onScanSuccess);
                </script>
            </div>
        </div>
    </div>

</div>
</div>

@endsection
