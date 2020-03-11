#include <SPI.h>
#include <Ethernet.h>
#include "DHT.h"

//Константы
#define DHTPIN 2
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

byte mac[] = { 
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; // Мак адрес

EthernetClient client;

//Переменные
unsigned long int timeConn = millis();      // Частота отправки данных о t/h на сервер
float h;                                    // Значение температуры
float t;                                    // Значение влажности
char server[] = "arduinosensordb.zzz.com.ua";

/*--------------------------------------------------------------
 Необходимые настройки
 --------------------------------------------------------------*/
void setup()
{
  //Старт
  Serial.begin(9600);
  Ethernet.begin(mac);
  dht.begin();
}
/*--------------------------------------------------------------
 Основное тело программы
 --------------------------------------------------------------*/
void loop()
{
  h = dht.readHumidity();
  t = dht.readTemperature();
  if (millis() - timeConn > 2000) {
    sendData(t,h);
    timeConn = millis();
    Serial.println("CONNECT SERVER: Send temp/hum");
  }
}
/*--------------------------------------------------------------
 Функция отправляет данные о температуре и влажности на 
 WEB сервер.
 --------------------------------------------------------------*/
void sendData(float t, float h) {
  client.connect(server, 80);
  client.print( "GET /add.php?");
  client.print("k=appInventor");//ключ что в add.php
  client.print("&");
  client.print("t=");
  client.print(t);
  client.print("&");
  client.print("h=");
  client.print(h);
  client.println(" HTTP/1.1");
  client.print( "Host: " );
  client.println(server);
  client.println( "Connection: close" );
  client.println();
  client.println();
  client.stop();
  client.flush();
}
