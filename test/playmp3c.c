/*
playmp3c , based on cmdmp3 v2.0 by Jim Lawless.
modified by suifengtec.
 */
#include <windows.h>
#include <stdio.h>
#include <string.h>
void sendCommand(char *);
int main(int argc,char **argv) {
   char shortBuffer[MAX_PATH];
   char cmdBuff[MAX_PATH + 64];
   if(argc<2) {
      /*
      Y:\DevSpace\PHP\Baidu\playerC
       */
      fprintf(stderr,"Syntax:\n\tcmdmp3 \"y:\\DevSpace\\PHP\\Baidu\\playerC\\file.mp3\"\n");
      return 1;
   }
   GetShortPathName(argv[1],shortBuffer,sizeof(shortBuffer));
   if(!*shortBuffer) {
      fprintf(stderr,"Cannot shorten filename \"%s\"\n",argv[1]);
      return 1;
   }
   sendCommand("Close All");
   sprintf(cmdBuff,"Open %s Type MPEGVideo Alias theMP3",shortBuffer);
   sendCommand(cmdBuff);
   sendCommand("Play theMP3 Wait");
   return 0;
}

void sendCommand(char *s) {
   int i;
   i=mciSendString(s,NULL,0,0);
   if(i) {
         fprintf(stderr,"Error %d when sending %s\n",i,s);
   }
}