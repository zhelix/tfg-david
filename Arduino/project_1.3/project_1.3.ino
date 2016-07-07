/*
 *  FILE:     project-v1.0.ino
 *  AUTHOR:   David Rodriguez Martinez  davidrm146@gmail.com
 *  VERSION:  1.1
 * 
 */
//Necessary Libraries
#include <Ethernet.h>
#include <SPI.h>
#include <TinyGPS.h>
#include "DHT.h"

//Config of the device
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
TinyGPS gps;
#define DHTPIN 2  
#define DHTTYPE DHT11  
DHT dht(DHTPIN, DHTTYPE);
IPAddress ip(192, 168, 1, 177);
EthernetClient client;
String data;


void setup()
{  
  Serial.print("EXECUTING setup");
  Serial.begin(9600);
  Serial2.begin(9600);
  
  if (Ethernet.begin(mac) == 0) {
      Serial.println("Failed to configure Ethernet using DHCP");
      Ethernet.begin(mac, ip);
  }
  delay(1000);   // A Small delay for avoid errors
}

void loop(){
   Serial.print("EXECUTING LOOP");
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



 //The next variable keeps the information collected by the sensors
 data = 
 "board1=" +  getID()  +
 "&temp1=" +  getTemperature()  + 
 "&hum1=" + getHumidity() +
 "&gas1="+ getGas() + 
 "&noise1=" + getNoise() +
 "&light1="+ getLight() + 
 "&poslat1=" + String(flat, 6) + 
 "&poslon1=" + String(flon, 6);

 //Debug function
  data = 
 "board1=arduino2&temp1=23&hum1=43&gas1=53&&noise1=54&light1=55&poslat1=63&poslon1=73";

  //This function is for send information to the server
  sendDataGet(data);
  
  delay(10);
}



void displayData(String data) {
  Serial.println("GET /server/add.php HTTP/1.1");
  Serial.println("Host: 192.168.1.18");
  Serial.println("Content-Type: application/x-www-form-urlencoded");
  Serial.print("Content-Length: ");
  Serial.print(data.length());
  Serial.println();
  Serial.println(data);
}

void sendDataPost(String data) {
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
      client.stop();
    }
    
}

void sendDataGet(String data) {
  if (client.connect("192.168.1.18", 80)){
    client.print("GET /server/add.php?");
    client.print(data);
    client.println("HTTP/1.1");
    client.println("Host: 192.168.0.104");        
    client.println("Connection: close");
    client.println();
  }
    if (client.connected()) { 
      client.stop();
    }
    
}

String getGas() {
    return String(analogRead(A10));
}

String getTemperature() {
    float t = dht.readTemperature();
    float f = dht.readTemperature(true);
    if (isnan(t) || isnan(f)) {
      Serial.println("Failed to read Temperature from DHT. . .");
      return "err";
    }
    return String(t, 2);
}

String getHumidity() {
  float h = dht.readHumidity();
  if (isnan(h)) {
    Serial.println("Failed to read Humidity from DHT. . .");
    return "err";
  }
  return String(h, 2);
}

String getNoise() {
  
  return "getNoise";
}

String getLight() {

  return "getLight";
}

String getID() {
  return "arduino2";
}



