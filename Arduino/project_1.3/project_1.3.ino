/*
 *  FILE:     project-v1.0.ino
 *  AUTHOR:   David Rodriguez Martinez  davidrm146@gmail.com
 *  VERSION:  1.3
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
IPAddress ip(192, 168, 1, 102);
EthernetClient client;
String data;


void setup()
{  
  Serial.println("EXECUTING setup");
  Serial.begin(9600);
  Serial2.begin(9600);
  
  if (Ethernet.begin(mac) == 0) {
      Serial.println("Failed to configure Ethernet using DHCP");
      Ethernet.begin(mac, ip);
  }
  delay(1000);   // A Small delay for avoid errors
}

void loop(){
   Serial.println("EXECUTING LOOP");
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
 "board_id=" +  getID()  +
 "&temp=" +  getTemperature()  + 
 "&hum=" + getHumidity() +
 "&gas="+ getGas() + 
 "&noise=" + getNoise() +
 "&luz="+ getLight() + 
 "&poslat=" + String(flat, 6) + 
 "&poslon=" + String(flon, 6);

  //Debug function, this string works
  //data ="board_id=1&temp=23&hum=43&gas=53&noise=54&luz=55&poslat=63&poslon=73";
  displayData(data);
  
  //This function is for send information to the server
  sendDataGet(data);

  delay(10000);
}


/*
* Debugger option
*/
void displayData(String data) {
  Serial.print("GET /call?");
  Serial.println(data);
  Serial.println("HTTP/1.1");
  Serial.println("Host: 192.168.1.16");        
  Serial.println("Connection: close");
  Serial.println();
}

void sendDataGet(String data) {
  if (client.connect("192.168.1.16",8888)){
    client.print("GET /call?");
    client.println(data);
    client.println("HTTP/1.1");
    client.println("Host: 192.168.1.16");        
    client.println("Connection: close");
    client.println();
  }
    if (client.connected()) { 
      client.stop();
    }
    
}

String getGas() {
    return String(analogRead(A0));
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
  
  return String(analogRead(A2));
}

String getLight() {
  return String(analogRead(A1));
}

String getID() {
  return "1";
}

/******Deprecated******/
void sendDataPost(String data) {
  if (client.connect("192.168.1.16", 80)){
    Serial.println("connected");
    client.println("POST /add.php HTTP/1.1");
    client.println("Host: 192.168.1.16");        
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




