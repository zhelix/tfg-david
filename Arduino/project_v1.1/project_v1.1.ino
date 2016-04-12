/*
 *  FILE:     project-v1.0.ino
 *  AUTHOR:   David Rodriguez Martinez  davidrm146@gmail.com
 *  VERSION:  1.1
 * 
 */

#include <Ethernet.h>
#include <SPI.h>
#include <TinyGPS.h>
#include "DHT.h"


//Config of the device
TinyGPS gps;
#define DHTPIN 2  
#define DHTTYPE DHT11  
DHT dht(DHTPIN, DHTTYPE);
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192, 168, 1, 177);
EthernetClient client;
String data;


void setup()
{  
  Serial.begin(9600);
  Serial2.begin(9600);
  if (Ethernet.begin(mac) == 0) {
      Serial.println("Failed to configure Ethernet using DHCP");
      Ethernet.begin(mac, ip);
  }
  delay(1000);   // Un pequeño delay para evitar errores
}

void loop(){
  //***************GPS CODE*********************
    bool newData = false;
    unsigned long chars;
    unsigned short sentences, failed;
    for (unsigned long start = millis(); millis() - start < 1000;){
      while (Serial2.available()){
        char c = Serial2.read();
        if (gps.encode(c))newData = true;
      }
    }
    float flat, flon;
    unsigned long age;
    gps.f_get_position(&flat, &flon, &age);
    Serial.print("LAT=");
    Serial.print(flat == TinyGPS::GPS_INVALID_F_ANGLE ? 0.0 : flat, 6);
    Serial.print(" LON=");
    Serial.print(flon == TinyGPS::GPS_INVALID_F_ANGLE ? 0.0 : flon, 6);
    Serial.print(" SAT=");
    Serial.print(gps.satellites() == TinyGPS::GPS_INVALID_SATELLITES ? 0 : gps.satellites());
    Serial.print(" PREC=");
    Serial.println(gps.hdop() == TinyGPS::GPS_INVALID_HDOP ? 0 : gps.hdop());

  //***************DTH Code**************************
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  float f = dht.readTemperature(true);
  if (isnan(h) || isnan(t) || isnan(f)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
   
  //***************Parallax CO2 Sensor code***********
    String gas=String(analogRead(A10));
    Serial.println("Gas Value:" + gas);  
    
 //***************String a Mandar**************
 //Check Varaibles in the webService / Revisar variables en el webservice 
 
 data = "temp1=" + String(dht.readTemperature(), 2)  + "&hum1=" + String(dht.readHumidity(), 2)+"&gas1="+ gas + "&poslat1=" + String(flat, 6)+ "&poslon1=" + String(flon, 6);
 
 //***************Web Service Code**************
    if (client.connect("192.168.0.104", 80)){
      Serial.println("connected");
      client.println("POST /add.php HTTP/1.1");
      client.println("Host: 192.168.0.104");        
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println(); 
      client.print(data); 
    }
    if (client.connected()) { 
      client.stop();  // DISCONNECT FROM THE SERVER
    }
    //Comprobamos que el post esta bien formulado (no funcionaba al principio) 
    Serial.println("POST /server/add.php HTTP/1.1");
    Serial.println("Host: 192.168.1.18");
    Serial.println("Content-Type: application/x-www-form-urlencoded");
    Serial.print("Content-Length: ");
    Serial.print(data.length());
    Serial.println();
    Serial.println(data);
  //*************Little Delay******************
  delay(15000);
}

