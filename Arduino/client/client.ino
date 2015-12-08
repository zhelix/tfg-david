#include <Ethernet.h>
#include <SPI.h>

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0x01 }; // RESERVED MAC ADDRESS
EthernetClient client;

String t;	// Ejemplo Temperatura
String h;	// Ejemplo Humedad
String data;

void setup() { 
  
	Serial.begin(9600);
	if (Ethernet.begin(mac) == 0) {
		Serial.println("Failed to configure Ethernet using DHCP"); 
	}
	delay(1000);   // Un pequeño delay para evitar errores
	data = "";
}

void loop(){
                  t="30";
                  h="30";
        
        //String a enviar, a poder ser es preferible que las variables coincidan
	data = "temp1=" + t + "&hum1=" + h;

        //Realizamos la conexion al servidor
        if (client.connect("192.168.1.18", 80)) {
          Serial.println("connected");
     
          // Enviamos los datos al servidor
          client.println("POST /add.php HTTP/1.1");
          client.println("Host: 192.168.1.18");        
          client.println("Content-Type: application/x-www-form-urlencoded");
	  client.print("Content-Length: ");
          client.println(data.length());
	  client.println(); 
	  client.print(data); 
            
            //Comprobamos que el post esta bien formulado (no funcionaba al principio)
            Serial.println("POST /server/add.php HTTP/1.1");
            Serial.println("Host: 192.168.1.18");
            Serial.println("Content-Type: application/x-www-form-urlencoded");
            Serial.print("Content-Length: ");
            Serial.print(data.length());
            Serial.println();
            Serial.print(data);
            
        }
        
        else {
          Serial.println("connection failed");
        }
        
	if (client.connected()) { 
		client.stop();	// Desconectamos del servidor
	}

	delay(20000);
}

