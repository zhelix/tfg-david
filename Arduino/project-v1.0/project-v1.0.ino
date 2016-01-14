#include "DHT.h"
#include <Ethernet.h>
#include <SPI.h>

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0x01 }; // RESERVED MAC ADDRESS
EthernetClient client;
DHT dht;
String data;
double floatVal=1.2;
char charVal[10];               //temporarily holds data from vals 
String stringVal = "";     //data on buff is copied to this string

void setup()
{
  Serial.begin(9600);
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP"); 
  }
  delay(1000);   // Un pequeño delay para evitar errores
  dht.setup(2); // data pin 2
  data = "";
}

void loop()
{
  Serial.println("ELAVVVV");
  delay(dht.getMinimumSamplingPeriod());
  //Un parse String par poder enviarlo al servidor
  String temperatura=dtostrf(dht.getTemperature(), 4, 4, charVal);
  String humedad=dtostrf(dht.getHumidity(), 4, 4, charVal);
  //String co2=String(analogRead(A5));
  //WebClient
  data = "temp1=" + temperatura  + "&hum1=" + humedad + "&gas1=" ;
  /*if (client.connect("192.168.1.18", 80)) {
      Serial.println("connected");
      // Enviamos los datos al servidor
      client.println("POST /add.php HTTP/1.1");
      client.println("Host: 192.168.1.18");        
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println(); 
      client.print(data); 
   }*/
     //Comprobamos que el post esta bien formulado (no funcionaba al principio)
            Serial.println("POST /server/add.php HTTP/1.1");
            Serial.println("Host: 192.168.1.18");
            Serial.println("Content-Type: application/x-www-form-urlencoded");
            Serial.print("Content-Length: ");
            Serial.print(data.length());
            Serial.println();
            Serial.print(data);
}

