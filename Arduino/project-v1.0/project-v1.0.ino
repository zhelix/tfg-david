
//
//    FILE: dht11_test.ino
//  AUTHOR: Rob Tillaart
// VERSION: 0.1.00
// PURPOSE: DHT library test sketch for DHT11 && Arduino
//     URL:
//
// Released to the public domain
//
#include <Ethernet.h>
#include <SPI.h>
#include <dht.h>

dht DHT;

#define DHT11_PIN 5
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192, 168, 1, 177);
EthernetClient client;
String data,temperature,humidity;
void setup()
{
  Serial.begin(9600);
  if (Ethernet.begin(mac) == 0) {
      Serial.println("Failed to configure Ethernet using DHCP");
      Ethernet.begin(mac, ip);
  }
  delay(1000);   // Un pequeño delay para evitar errores
}

void loop()
{
  // READ DATA
  Serial.print("DHT11, \t");
  int chk = DHT.read11(DHT11_PIN);

  // DISPLAY DATA
  Serial.print(DHT.humidity, 1);
  Serial.print(",\t");
  Serial.println(DHT.temperature, 1);
  	
 data = "temp1=" + String(DHT.temperature, 2)  + "&hum1=" + String(DHT.humidity, 2) ;
  
 if (client.connect("192.168.1.18", 80)) {
      Serial.println("connected");
      client.println("POST /add.php HTTP/1.1");
      client.println("Host: 192.168.1.18");        
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println(); 
      client.print(data); 
   }
  //Comprobamos que el post esta bien formulado (no funcionaba al principio) 
  Serial.println("POST /server/add.php HTTP/1.1");
  Serial.println("Host: 192.168.1.18");
  Serial.println("Content-Type: application/x-www-form-urlencoded");
  Serial.print("Content-Length: ");
  Serial.print(data.length());
  Serial.println();
  Serial.print(data);
  delay(2000);
}
//
// END OF FILE
//
