import './bootstrap';
import './vue';

window.Echo.private('my-private-channel').listen('.App\\Events\\TacoSaladEvent', (event) => {
    alert('Private! ' + JSON.stringify(event));
});

window.Echo.channel('my-public-channel').listen('.App\\Events\\TacoSaladEvent', (event) => {
    alert('Public! ' + JSON.stringify(event));
});
