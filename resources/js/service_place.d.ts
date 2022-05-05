export interface ServicePlace {
    name: string;
    description: string;
    phone_number: string;
    latitude: number;
    longitude: number;
    service_place_type: {
        id: number;
        name: string;
    };
}
