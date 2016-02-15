//
//  BetCell.swift
//  SafeInRio
//
//  Created by Amanda Aurita Araujo Fernandes on 12/12/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import UIKit

class GameCell: UITableViewCell{
    
    //-----Altura da célula (Muda o tamanho da imagem também)------
    let altura : CGFloat = 200.0
    
    //Variables
    var sportLbl: UILabel!
    var team1: UIImageView!
    var team2: UIImageView!
    var xLabel: UILabel!
    var time: UILabel!
    
    
    required init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)!
        
    }
    
    override init(style: UITableViewCellStyle, reuseIdentifier: String?) {
        super.init(style: style, reuseIdentifier: "BetCell")
        
        //Pegando o tamanho da tela:
        let screenSize: CGRect = UIScreen.mainScreen().bounds
        let screenWidth = screenSize.width
        
        //Definindo o tamanho e a cor da célula
        self.frame = CGRectMake(0, 0, screenWidth, altura)
        self.backgroundColor = UIColor.amarelo()
        
        //------Imagens:--------
        team1 = UIImageView(frame: CGRectMake(screenWidth/2, 12, 48, 48))
        self.addSubview(team1)
        
        team2 = UIImageView(frame: CGRectMake(screenWidth/2 + 70, 12, 48, 48))
        self.addSubview(team2)
        
        //--------Labels-----
        self.sportLbl = UILabel(frame: CGRectMake(0, 12, 200, 40))
        sportLbl.textColor = UIColor.azulClaro()
        sportLbl.textAlignment = NSTextAlignment.Left
        sportLbl.font = UIFont.systemFontOfSize(20)
        self.addSubview(sportLbl)
        
        self.xLabel = UILabel(frame: CGRectMake(screenWidth/2 + 53, 25, 16, 16))
        xLabel.text = "x"
        self.addSubview(xLabel)
        
        time = UILabel()
        time.frame = CGRectMake(5, 30, 200, 40)
        time.textAlignment = NSTextAlignment.Left
        time.font = UIFont.systemFontOfSize(12)
        time.text = "asd"
        self.addSubview(time)

        
    }
}