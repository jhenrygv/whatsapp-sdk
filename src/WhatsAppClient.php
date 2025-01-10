<?php

namespace Wapi2;

class WhatsAppClient
{
    private string $baseUrl;
    private string $accessToken;
    private $httpClient;

    public function __construct(string $baseUrl, string $accessToken)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->accessToken = $accessToken;
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
    }

    /**
     * Send a text message to a specific phone number
     *
     * @param string $phone Phone number
     * @param string $message Text message to send
     * @return array Response from the API
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessage(string $phone, string $message): array
    {
        $response = $this->httpClient->post("/chat/{$phone}/message", [
            'json' => ['message' => $message]
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send an image to a specific phone number
     *
     * @param string $phone Phone number
     * @param string $image Base64 string or URL of the image
     * @param string|null $caption Optional caption for the image
     * @return array Response from the API
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendImage(string $phone, string $image, ?string $caption = null): array
    {
        $data = ['image' => $image];
        if ($caption !== null) {
            $data['caption'] = $caption;
        }

        $response = $this->httpClient->post("/chat/{$phone}/image", [
            'json' => $data
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a PDF document to a specific phone number
     *
     * @param string $phone Phone number
     * @param string $pdf Base64 string or URL of the PDF
     * @param string|null $caption Optional filename for the PDF
     * @return array Response from the API
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendPdf(string $phone, string $pdf, ?string $caption = null): array
    {
        $data = ['pdf' => $pdf];
        if ($caption !== null) {
            $data['caption'] = $caption;
        }

        $response = $this->httpClient->post("/chat/{$phone}/pdf", [
            'json' => $data
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a location to a specific phone number
     *
     * @param string $phone Phone number
     * @param float $latitude Latitude coordinate
     * @param float $longitude Longitude coordinate
     * @param string|null $description Optional location description
     * @return array Response from the API
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendLocation(string $phone, float $latitude, float $longitude, ?string $description = null): array
    {
        $data = [
            'latitude' => $latitude,
            'longitude' => $longitude
        ];
        
        if ($description !== null) {
            $data['description'] = $description;
        }

        $response = $this->httpClient->post("/chat/{$phone}/location", [
            'json' => $data
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get chat information by phone number
     *
     * @param string $phone Phone number
     * @return array Chat information
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getChatInfo(string $phone): array
    {
        $response = $this->httpClient->get("/chat/{$phone}");
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get all chats
     *
     * @return array List of all chats
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllChats(): array
    {
        $response = $this->httpClient->get("/chat");
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get all WhatsApp contacts
     *
     * @return array List of contacts
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllContacts(): array
    {
        $response = $this->httpClient->get("/contact/getcontacts");
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get contact information by phone number
     *
     * @param string $phone Phone number
     * @return array Contact information
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getContactInfo(string $phone): array
    {
        $response = $this->httpClient->get("/contact/getcontact/{$phone}");
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get contact profile picture URL
     *
     * @param string $phone Phone number
     * @return array Profile picture information
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getProfilePicture(string $phone): array
    {
        $response = $this->httpClient->get("/contact/getprofilepic/{$phone}");
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Check if a phone number is registered on WhatsApp
     *
     * @param string $phone Phone number to check
     * @return array Registration status
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function isRegisteredUser(string $phone): array
    {
        $response = $this->httpClient->get("/contact/isregistereduser/{$phone}");
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a text message to a group
     *
     * @param string $chatname Group chat name
     * @param string $message Text message to send
     * @return array Response from the API
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendGroupMessage(string $chatname, string $message): array
    {
        $response = $this->httpClient->post("/group/sendmessage/{$chatname}", [
            'json' => ['message' => $message]
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send an image to a group
     *
     * @param string $chatname Group chat name
     * @param string $image Base64 string or URL of the image
     * @param string|null $caption Optional caption for the image
     * @return array Response from the API
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendGroupImage(string $chatname, string $image, ?string $caption = null): array
    {
        $data = ['image' => $image];
        if ($caption !== null) {
            $data['caption'] = $caption;
        }

        $response = $this->httpClient->post("/group/sendimage/{$chatname}", [
            'json' => $data
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a PDF document to a group
     *
     * @param string $chatname Group chat name
     * @param string $pdf Base64 string or URL of the PDF
     * @param string|null $caption Optional filename for the PDF
     * @return array Response from the API
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendGroupPdf(string $chatname, string $pdf, ?string $caption = null): array
    {
        $data = ['pdf' => $pdf];
        if ($caption !== null) {
            $data['caption'] = $caption;
        }

        $response = $this->httpClient->post("/group/sendpdf/{$chatname}", [
            'json' => $data
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a location to a group
     *
     * @param string $chatname Group chat name
     * @param float $latitude Latitude coordinate
     * @param float $longitude Longitude coordinate
     * @param string|null $description Optional location description
     * @return array Response from the API
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendGroupLocation(string $chatname, float $latitude, float $longitude, ?string $description = null): array
    {
        $data = [
            'latitude' => $latitude,
            'longitude' => $longitude
        ];
        
        if ($description !== null) {
            $data['description'] = $description;
        }

        $response = $this->httpClient->post("/group/sendlocation/{$chatname}", [
            'json' => $data
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }
}