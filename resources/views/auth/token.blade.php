<script>
window.opener.postMessage({ type: 'jwt', token: '{{$token}}', user: '{{$authUser->id}}'}, '*');
window.close();
</script>