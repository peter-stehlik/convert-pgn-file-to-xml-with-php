# Convert .PGN file to XML with PHP
If creating/working with chess databases, with this PHP script you can easily convert .PGN file into XML.

Convert this:
```
[Event "Sachova Extraliga SK Commander 2013/14"]
[Site "Bratislava (Doprastav)"]
[Date "2013.11.09"]
[Round "1"]
[Board "1"]
[White "Lipka, Juraj"]
[Black "Petrik, Tomas"]
[Result "1/2-1/2"]
[ECO "A30"]
[WhiteElo "2410"]
[BlackElo "2519"]
[PlyCount "33"]
[EventDate "2013.11.09"]
[EventType "team"]
[EventRounds "11"]
[EventCountry "SVK"]
[WhiteTeam "SK Doprastav Bratislava"]
[BlackTeam "SO SKM Stara Lubovna"]
  
1. Nf3 Nf6 2. c4 c5 3. g3 b6 4. Bg2 Bb7 5. O-O e6 6. Nc3 Be7 7. d4 cxd4 8. Qxd4 d6 9. Bg5 a6 10. Bxf6 Bxf6 11. Qf4 Bxf3 12. exf3 Ra7 13. Rfd1 Rd7 14. Qe3 O-O 15. f4 Qc7 16. Rac1 g6 17. b3 1/2-1/2
```
into:
```xml
<Game>
  <Event>Sachova Extraliga SK Commander 2013/14</Event>
  <Site>Bratislava (Doprastav)</Site>
  <Date>2013.11.09</Date>
  <Round>1</Round>
  <Board>1</Board>
  <White>Lipka, Juraj</White>
  <Black>Petrik, Tomas</Black>
  <Result>1/2-1/2</Result>
  <ECO>A30</ECO>
  <WhiteElo>2410</WhiteElo>
  <BlackElo>2519</BlackElo>
  <PlyCount>33</PlyCount>
  <EventDate>2013.11.09</EventDate>
  <EventType>team</EventType>
  <EventRounds>11</EventRounds>
  <EventCountry>SVK</EventCountry>
  <WhiteTeam>SK Doprastav Bratislava</WhiteTeam>
  <BlackTeam>SO SKM Stara Lubovna</BlackTeam>
  <Moves>1. Nf3 Nf6 2. c4 c5 3. g3 b6 4. Bg2 Bb7 5. O-O e6 6. Nc3 Be7 7. d4 cxd4 8. Qxd4 d6 9. Bg5 a6 10. Bxf6 Bxf6 11. Qf4 Bxf3 12. exf3 Ra7 13. Rfd1 Rd7 14. Qe3 O-O 15. f4 Qc7 16. Rac1 g6 17. b3 1/2-1/2</Moves>
</Game>
```
## How to use it?

1. copy **convert.php** script into your local folder
2. change names(locations) of files, if necessary
3. run the script in browser

## You will be interested:
**Is there any restriction to number of parameters of game?** - 
Nope, as many parameters are in .PGN as will be in XML.

**What if there is time information next to the moves.** - 
This info is removed from XML, only moves are stored.

### Possible issue

I have not tested it with .PGN containing text comments in the games.

## Enjoy :-)
