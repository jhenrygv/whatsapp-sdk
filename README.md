# WhatsApp SDK for PHP

SDK oficial para integrar WhatsApp Web API en aplicaciones PHP. Compatible con PHP 7.4 en adelante.

## Requisitos

- PHP >= 7.4
- Guzzle HTTP Client
- Acceso a WhatsApp Web API (token de acceso)

## Instalación

```json
{
    "require": {
        "wapi2/whatsapp-sdk": "dev-main"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/jhenrygv/whatsapp-sdk.git"
        }
    ]
}
```

Luego ejecutar:
```bash
composer install
```

## Uso Rápido

```php
<?php

require 'vendor/autoload.php';

use Wapi2\WhatsAppClient;

// Inicializar cliente
$client = new WhatsAppClient('https://wapi2.com:3030', 'tu-token-de-acceso');

// Enviar mensaje
// Nota: El número debe incluir código de país sin el símbolo +
// Ejemplo: 51999999999 (Perú)
$response = $client->sendMessage('51999999999', '¡Hola desde WhatsApp!');
```

## Características Principales

- Envío de mensajes de texto
- Envío de imágenes con descripción
- Envío de documentos PDF
- Envío de ubicaciones
- Gestión de chats y contactos
- Funcionalidades para grupos

## Métodos Disponibles

### Mensajes
- `sendMessage(string $phone, string $message)` - Envía mensaje de texto
- `sendImage(string $phone, string $image, ?string $caption)` - Envía imagen
- `sendPdf(string $phone, string $pdf, ?string $caption)` - Envía documento PDF
- `sendLocation(string $phone, float $latitude, float $longitude, ?string $description)` - Envía ubicación

### Chats
- `getChatInfo(string $phone)` - Obtiene información del chat
- `getAllChats()` - Lista todos los chats

### Contactos
- `getAllContacts()` - Obtiene todos los contactos
- `getContactInfo(string $phone)` - Obtiene información de un contacto
- `getProfilePicture(string $phone)` - Obtiene foto de perfil
- `isRegisteredUser(string $phone)` - Verifica si el número está registrado

### Grupos
- `sendGroupMessage(string $chatname, string $message)` - Envía mensaje a grupo
- `sendGroupImage(string $chatname, string $image, ?string $caption)` - Envía imagen a grupo
- `sendGroupPdf(string $chatname, string $pdf, ?string $caption)` - Envía PDF a grupo
- `sendGroupLocation(string $chatname, float $latitude, float $longitude, ?string $description)` - Envía ubicación a grupo

## Formato del Número de Teléfono

Los números de teléfono deben incluir el código de país sin el símbolo +

Ejemplos:
- Perú (51): 51999999999
- México (52): 52999999999
- Colombia (57): 57999999999
- España (34): 34999999999

## Manejo de Errores

El SDK utiliza excepciones de Guzzle para el manejo de errores. Se recomienda implementar try-catch:

```php
try {
    $response = $client->sendMessage('51999999999', 'Mensaje de prueba');
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    echo "Error: " . $e->getMessage();
}
```

## Soporte

Para reportar problemas o solicitar nuevas características, por favor crear un issue en el repositorio:
https://github.com/jhenrygv/whatsapp-sdk/issues