package project;
import java.lang.Object;
import java.io.InputStream;
import java.io.FilterInputStream;
import java.io.DataInputStream;
import java.io.IOException;

public class lexanz {

    public class Token
{
    static final int capital_letter=0;
    static final int letter=1;
    static final int digit=2;
    static final int space=3;
    static final int unknown=4;
    static final int forwardsortationarea=5;
    static final int localdeliveryunit=6;
    static final int postal_code=7;
}
public int charclass;
public int currentchar;
public DataInputStream in;
lexanz(DataInputStream code)
{this.in=code;}
public int TokenCode;
public int part1;
public int part2;
public int lexeme[]=new int[100];
public int lexlen=0;
public void getchar() throws IOException 
{
    currentchar=in.read();
    if(Character.isUpperCase(currentchar)&& currentchar!='W'&&currentchar!='Z')
        charclass=Token.capital_letter;
    else if(Character.isUpperCase(currentchar)&&currentchar!='U'&&currentchar!='O'&&currentchar!='Q'&&currentchar!='D'&&currentchar!='F'&&currentchar!='I')
        charclass=Token.letter;
    else if(Character.isDigit(currentchar))
        charclass=Token.digit;
    else if(Character.isWhitespace(currentchar))
        charclass=Token.space;   
    else
        charclass=Token.unknown;
}
public void addchar() 
{
    if(lexlen<=100)
        lexeme[lexlen++]=currentchar;
 
    else
        System.out.println("ERROR!!");

}
public int lex() throws IOException 
{
    System.out.println("lexeme\ttoken");
    while(currentchar!='\n')
    {
        if(charclass==0)
        {
            System.out.printf("%c\t",currentchar);
            System.out.println("letter");
            addchar();
            getchar();

        }
        if(charclass==1)
        {
            System.out.printf("%c\t",currentchar);
            System.out.println("special_letter");           
            addchar();
            getchar();
        }
        if(charclass==2)
        {
            System.out.printf("%c\t", currentchar);
            System.out.println("digit");            
            addchar();
            getchar();
        }
        if(charclass==3)
        {
            System.out.printf("%c\t", currentchar);
            System.out.println("space");            
            addchar();
            getchar();
        }
        if(charclass==4)
        {
            System.out.printf("%c\t", currentchar);
            System.out.println("unknown");            
            addchar();
            getchar();
        }
        
            
        
      
    }
        if(Character.isUpperCase(lexeme[0]))
            if(lexeme[0]!=87&&lexeme[0]!=90)
                if(Character.isDigit(lexeme[1]))
                    if(Character.isUpperCase(lexeme[2])&&lexeme[2]!='U'&&lexeme[2]!='O'&&lexeme[2]!='Q'&&lexeme[2]!='D'&&lexeme[2]!='F'&&lexeme[2]!='I')
                    { part1=Token.forwardsortationarea;
                    TokenCode=part1;
                    }
        if(Character.isDigit(lexeme[4]))
            if(Character.isUpperCase(lexeme[5])&&lexeme[5]!='U'&&lexeme[5]!='O'&&lexeme[5]!='Q'&&lexeme[5]!='D'&&lexeme[5]!='F'&&lexeme[5]!='I')
                if(Character.isDigit(lexeme[6])){
                    part2=Token.localdeliveryunit;                   
                    TokenCode=part2;}
                    
        
        if(part1==5)
        {
            System.out.printf("%c",lexeme[0]);
            System.out.printf("%c",lexeme[1]);
            System.out.printf("%c",lexeme[2]);
            System.out.println("\tforwardsortationarea");
        }
        if(part2==6)
        {
            System.out.printf("%c",lexeme[4]);
            System.out.printf("%c",lexeme[5]);
            System.out.printf("%c",lexeme[6]);
            System.out.println("\tlocaldeliveryunit");
        }
        if((part1+part2)==11)
        {
            System.out.printf("%c",lexeme[0]);
            System.out.printf("%c",lexeme[1]);
            System.out.printf("%c",lexeme[2]);
            System.out.printf("%c",lexeme[3]);
            System.out.printf("%c",lexeme[4]);
            System.out.printf("%c",lexeme[5]);
            System.out.printf("%c",lexeme[6]);            
            System.out.println("\tpostal_code");
            TokenCode=Token.postal_code;
        }
        return TokenCode;
      
}
}

